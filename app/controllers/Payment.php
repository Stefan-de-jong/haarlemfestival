<?php
class Payment extends Controller{        
    public function __construct(){   
        $this->cartitemRepo = $this->repo('CartItemRepository');
        $this->ticketRepo = $this->repo('TicketRepository');
        $this->eventRepo = $this->repo('EventRepository');
       
        $this->cartitemModel = $this->model('CartItem');
        $this->historicItemModel = $this->model('HistoricCartItem');
        $this->foodModel = $this->model('FoodCartItem');
        $this->danceModel = $this->model('DanceCartItem');

        $this->ticketModel = $this->model('Ticket');
        $this->hticketModel = $this->model('HistoricTicket');
        $this->fticketModel = $this->model('FoodTicket');
        $this->dticketModel = $this->model('DanceTicket');
        //$this->jticketModel = $this->model('JazzTicket');  
    }

    public function index()
    {        
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }
        if(!count($_SESSION['cart'])>0){
            flash('emptyCart_alert', 'Your cart is empty, no items to checkout', 'alert alert-danger');
            redirect('cart/paymentdetails'); // waarheen?            
        }

        if($_SERVER['REQUEST_METHOD']=== 'POST'){            
            // Sanitize customer inputs
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // ToDo add check for emailaddress match 2nd emailaddress
            // emailcheck ....

            if(!empty($_SESSION['customer_email']))
                $email = $_SESSION['customer_email'];
            else
                $email = trim($_POST['emailaddress']);
            $cartitems = $this->getCartItems();
            $amount = 0;
            foreach ($cartitems as $item) {
                $amount += $item->getPrice() * $item->getAmount();
            }
            
            // Init data everytime a payment is started
            $data = [
                'customer_email' => $email,
                'cart_items' => $cartitems,
                'tickets' => '',
                'total_price' => $amount
            ];           

            // ToDo Thijs -> omdat deze variabele na iedere request wordt geinitialiseerd nu in session, kan dit anders?
            $_SESSION['data'] = $data;            

            $this->view('payment/mollie', $data);
        }
        else redirect('cart/paymentdetails'); // waarheen?        
    }

    public function succes()
    {   
        // ToDo Thijs -> omdat deze variabele na iedere request wordt geinitialiseerd nu in session, kan dit anders?
        $data = $_SESSION['data'];
               
        $tickets = [];              
        foreach ($data['cart_items'] as $item) {
            for ($i=0; $i < $item->getAmount(); $i++) {
                // update available tickets
                $this->eventRepo->updateTickets($item->getEventId(), $item->getTicketType());
                switch ($item->getEventType()) {
                    case 'Haarlem Dance':
                        $ticket = new DanceTicket($item->getEventId(),$item->getTicketType(),$item->getPrice(),$data['customer_email'], $item->getEventType(), $item->getDate(), $item->getTime(), $item->getPrice(), $item->getVenue());
                        break;
                    case 'Haarlem Food':
                        $ticket = new FoodTicket($item->getEventId(),$item->getTicketType(),$item->getPrice(),$data['customer_email'], $item->getEventType(), $item->getDate(), $item->getTime(), $item->getRestName(), $item->getSession());
                        break;
                    case 'Haarlem Historic':
                        $ticket = new HistoricTicket($item->getEventId(),$item->getTicketType(),$item->getPrice(),$data['customer_email'], $item->getEventType(), $item->getDate(), $item->getTime(), $item->getLanguage());
                        break;
                    case 'Haarlem Jazz':
                        //$ticket = new JazzTicket($item->getEventId(),$item->getTicketType(),$item->getPrice(),$data['customer_email'], $item->getEventType(), $item->getDate(), $item->getTime());
                        break;                        
                } 
                if($this->ticketRepo->save($ticket)){
                    // die($ticket->getTicketId()); Werkt, tickets komt dus in DB en ID is gezet in ticket object                               
                    $tickets[] = $ticket;
                } else {
                    die('Something went wrong');
                }                
            }
        }        
        // get tickets in data
        $data['tickets'] = $tickets;
        $this->createPDF($data);
        //$this->view('payment/process', $data);        
    }

    public function createPDF($data){
        $customerEmail = $data['customer_email'];
        $pdf = new TCPDF();

        foreach($data['tickets'] as $ticket) {
            $ticketId = $ticket->getTicketId();
            $eventId = $ticket->getEventID();
            $ticketType = $ticket->getTicketType();
            $ticketPrice = $ticket->getTicketPrice();
            $eventType = $ticket->getEventType();
            $eventDate = date_format(date_create($ticket->getDate()),"d F Y");
            $eventTime = date_format(date_create($ticket->getTime()),"H:i") . ' uur';
            
            if($eventType == 'Haarlem Dance'){
                if (strpos($ticketType, 'dance_ticket') !== false)          
                {$eventArtist = $ticket->getArtist();
                $eventVenue = $ticket->getVenue();}
                else if (strpos($ticketType, 'all-access') !== false)
                {$eventArtist = "Multiple artist"; $eventVenue = "Multiple venues";}
                $html = "
                        <ul>
                            <li>Ticket ID: {$ticketId}</li>
                            <li>Event ID: {$eventId}</li>
                            <li>Name: {$eventType}</li>
                            <li>Type: {$ticketType}</li>
                            <li>Date: {$eventDate}</li>
                            <li>Time: {$eventTime}</li>
                            <li>Artist: {$eventRestaurant}</li>
                            <li>Venue: {$eventSession}</li>
                            <li>Price: € {$ticketPrice}</li>
                        </ul>
                        <style>
                        ul {
                            list-style-type: none;
                            padding: 0;
                            margin: 0;
                        }
                        </style>
                        ";
            }
            if($eventType == 'Haarlem Food'){                   
                $eventSession = $ticket->getSession();
                $eventRestaurant = $ticket->getRestName();
                $html = "
                        <ul>
                            <li>Ticket ID: {$ticketId}</li>
                            <li>Event ID: {$eventId}</li>
                            <li>Name: {$eventType}</li>
                            <li>Type: {$ticketType}</li>
                            <li>Date: {$eventDate}</li>
                            <li>Time: {$eventTime}</li>
                            <li>Restaurant: {$eventRestaurant}</li>
                            <li>Session: {$eventSession}</li>
                            <li>Price: € {$ticketPrice}</li>
                        </ul>
                        <style>
                        ul {
                            list-style-type: none;
                            padding: 0;
                            margin: 0;
                        }
                        </style>
                        ";
            }
            if($eventType == 'Haarlem Historic'){            
                $ticketType = $ticket->printTicketType();
                $eventLanguage = $ticket->getLanguage();
                $html = "
                        <ul>
                            <li>Ticket ID: {$ticketId}</li>
                            <li>Event ID: {$eventId}</li>
                            <li>Name: {$eventType}</li>
                            <li>Type: {$ticketType}</li>
                            <li>Date: {$eventDate}</li>
                            <li>Time: {$eventTime}</li>
                            <li>Language: {$eventLanguage}</li>
                            <li>Price: € {$ticketPrice}</li>
                        </ul>
                        <style>
                        ul {
                            list-style-type: none;
                            padding: 0;
                            margin: 0;
                        }
                        </style>
                        ";
            }
            if($ticket->getEventType() == 'Haarlem Jazz'){           
                // Insert code for ticket generatie
            }

            $pdf->addPage();        
            $qrcode = "{$ticketId} {$eventId} {$customerEmail}";    

            //line spacing
            $pdf->Ln(2);

            //write html
            $pdf->writeHTML($html);

            //line spacing
            $pdf->Ln(2);

            $style = array(
                'border' => 2,
                'vpadding' => 'auto',
                'hpadding' => 'auto',
                'fgcolor' => array(0,0,0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
            );
                
            // QRCODE
            $pdf->write2DBarcode($qrcode, 'QRCODE,H', 20, 210, 50, 50, $style, 'N');
        }
        ob_clean();
        $attachment = $pdf->Output('tickets.pdf', 'S');
        $data['attachment'] = $attachment;
        unset($_SESSION['cart']);
        $this->view('payment/succes', $data);
    }   

    private function getCartItems()
    {
        $cart_items = [];                  
        $ids = array();
        foreach ($_SESSION['cart'] as $id => $value) {
            array_push($ids, $id);
        }
        foreach ($ids as $id){
            // creating cart items for historic single tickets (if set)
            if(!empty($_SESSION['cart'][$id]['historic_single_ticket'])){
                $nSingle = $_SESSION['cart'][$id]['historic_single_ticket'];
                $type = 'historic_single_ticket';
                $cart_item = $this->cartitemRepo->findHistoric($id, $nSingle, $type);
                $cart_items[] = $cart_item;
            }
            // creating cart items for historic family tickets (if set)
            if(!empty($_SESSION['cart'][$id]['historic_fam_ticket'])){
                $nFamily = $_SESSION['cart'][$id]['historic_fam_ticket'];
                $type = 'historic_fam_ticket';
                $cart_item = $this->cartitemRepo->findHistoric($id, $nFamily, $type);
                $cart_items[] = $cart_item;
            }

            //Food regular
            if(!empty($_SESSION['cart'][$id]['food_regular_ticket'])){
                $regular_tickets = $_SESSION['cart'][$id]['food_regular_ticket'];
                $request = $_SESSION['cart'][$id]['food_request'];
                $type = 'food_regular';
                $cart_item = $this->cartitemRepo->findFood($id, $regular_tickets, $type, $request);
                $cart_items[] = $cart_item;
            }
            //food kids
            if(!empty($_SESSION['cart'][$id]['food_kids_ticket'])){
                $kids_tickets = $_SESSION['cart'][$id]['food_kids_ticket'];
                $request = $_SESSION['cart'][$id]['food_request'];
                $type = 'food_kids';
                $cart_item = $this->cartitemRepo->findFood($id, $kids_tickets, $type, $request);
                $cart_items[] = $cart_item;
            } 
            //dance_ticket
            if(!empty($_SESSION['cart'][$id]['dance_ticket'])){
                $general = $_SESSION['cart'][$id]['dance_ticket'];
                $type = 'dance_ticket';
                $cart_item = $this->cartitemRepo->findDance($id, $general, $type);
                $cart_items[] = $cart_item;
            }
            //all-access
            if(!empty($_SESSION['cart'][$id]['all_access'])){
                $general = $_SESSION['cart'][$id]['all_access'];
                $type = 'all_access';
                $cart_item = $this->cartitemRepo->findDance($id, $general, $type);
                $cart_items[] = $cart_item;
            }
        }
        return $cart_items;           
    }            
}
?>