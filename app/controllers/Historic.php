<?php
    class Historic extends Controller{
        public function __construct(){
            $this->locationRepo = $this->repo('LocationRepository');
            $this->locationModel = $this->model('Location');
            $this->tourRepo = $this->repo('TourRepository');
            $this->tourModel = $this->model('Tour');
            $this->ticketModel = $this->model('HistoricTicket');      
        }

        public function index(){
            $locations = $this->locationRepo->findAll();
            
            $data = [
                'title' => 'Historic tour',
                'locations' => $locations
            ];

            $this->view('historic/tour', $data);
        }

        public function about(){
            $data = [
                'title' => 'About Haarlem'
            ];

            $this->view('historic/about', $data);
        }

        public function tickets($date = '2020-07-24'){                        
            $tours = $this->tourRepo->findByDate($date);            
        
            $data = [
                'title' => 'Tickets',
                'tours' => $tours                
            ];

            $this->view('historic/tickets', $data);
        }

        public function order(){            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data =[
                'tour_date' => trim($_POST['selected_day']),
                'tour_time' => trim($_POST['selected_time']),
                'tour_language' => trim($_POST['selected_language']),
                'single_tickets' => trim($_POST['selected_singleTickets']),
                'fam_tickets' => trim($_POST['selected_famTickets']),
                'amount_error' => ''
            ];

            if($data['single_tickets'] == 0 && $data['fam_tickets'] == 0){
                flash('ticketNotAdded_alert', 'Please select a number of tickets', 'alert alert-danger');
                redirect('historic/tickets');
            }
            else{
                $tour = $this->tourRepo->find($data['tour_date'], $data['tour_time'], $data['tour_language']); // ToDo als gekozen id meegegeven kan worden vanuit tickets page -> zoeken naar ID
            
                if($tour != null){
                    $tickets = array();
                    // Check if ordered single tickets and fam tickets combined are not more then the available ammount for tour
                    if(!$tour->getNTickets() >= $data['single_tickets']+($data['fam_tickets']*4)){
                        // not enough tickets available
                        flash('ticketNotAdded_alert', 'Not enough tickets available', 'alert alert-danger');
                        redirect('historic/tickets');
                    } else{
                        $id = $tour->getId();
                        $n_single = $data['single_tickets'];
                        $n_fam = $data['fam_tickets'];
                        $cart_item = array(
                            'single_tickets' => $n_single,
                            'family_tickets' => $n_fam
                        );

                        if(!isset($_SESSION['cart'])){
                            $_SESSION['cart'] = array();
                        }

                        if(!array_key_exists($id, $_SESSION['cart'])){
                            $_SESSION['cart'][$id]=$cart_item;
                            flash('ticketAdded_succes', 'Ticket(s) added to cart', 'alert alert-success');
                            redirect('historic/tour');
                        }
                    }
                }      
            }                     
        }
    }
?>