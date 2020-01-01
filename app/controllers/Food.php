<?php
class Food extends Controller
{
    private $message;
    public function __construct(){
        $this->restaurantModel= $this->model('Restaurant');
        $this->ticketModel= $this->model('Ticket');
        $this->restaurantRepository = $this->repo('RestaurantRepository');
        $this->eventModel = $this->model('Event');
        $this->foodEventModel = $this->model('FoodEvent');
    }

    public function index()
    {
        $restaurants = $this->restaurantRepository->findAllRestaurants();

        $data = [
            'restaurants' => $restaurants
        ];

        $this->view('food/index', $data);
    
    }

    public function filter()
    {
        $kitchen = $_GET['kitchen'];

        $restaurants = $this->restaurantRepository->findAllRestaurantsBySpecificKitchen($kitchen);

        $data = [
            'restaurants' => $restaurants
        ];

        $this->view('food/index', $data);
    }

    public function info($restaurant)
    {
        if($this->restaurantRepository-> findRestaurantById($restaurant) == false)
            $this->index();

        $page = $this->restaurantRepository->getRestaurantInfoPage($restaurant);
        $events = $this->restaurantRepository->getEventByRestaurant($restaurant);
        $data = [
            'page' => $page,
            'event'=> $events,
            'error_message' =>$this->message
        ];
        $this->view('food/info', $data);
    }

    public function reservate()
    {
        $restaurant = $_GET['restaurant'];
        if($this->restaurantRepository-> findRestaurantById($restaurant) == false)
            $this->index();

        $date =$_POST['reservateDate'];
        $session = $_POST['session'];
        $regularTickets = $_POST['regularTickets'];
        $childTickets = $_POST['childTickets'];
        $specialRequest = $_POST['specialRequest'];

        if($specialRequest == "")
            $specialRequest = "No special request";

        $event = $this->restaurantRepository->getEventByInfo($date, $session, $restaurant);
        
        if($regularTickets == 0 && $childTickets == 0)
        {
            $this->message = "❗ Please select a ticket amount";
            $this->info($restaurant);
        }
        else if(($regularTickets + $childTickets) > $event->getNTickets())
        {
            $this->message = "❗ Selected ticket amount is to high, please check the availability!";
            $this->info($restaurant);
        }
        else if(!$session == 1 || !$session ==2 || !$session == 3)
        {
            $this->message = "❗ Select a choosable session";
            $this->info($restaurant);
        }
        else if(!$date == '2020-07-26' || !$date == '2020-07-27' || !$date == '2020-07-28' || !$date == '2020-07-29')
        {
            $this->message = "❗ Select a choosable date";
            $this->info($restaurant);
        }
        else {
            $id = $event->getId();
            $cart_item = array(
                'food_regular_ticket' => $regularTickets,
                'food_kids_ticket' => $childTickets,
                'food_request'=>$specialRequest
            );

            if(!isset($_SESSION['cart'])){
                $_SESSION['cart'] = array();
            }
            if(!array_key_exists($id, $_SESSION['cart'])){
                $_SESSION['cart'][$id]=$cart_item;
            } else {
                if(empty($_SESSION['cart'][$id]['food_regular_ticket']) && empty($_SESSION['cart'][$id]['food_kids_ticket']))
                {
                    $_SESSION['cart'][$id]['food_regular_ticket'] = $cart_item['food_regular_ticket'];
                    $_SESSION['cart'][$id]['food_kids_ticket'] = $cart_item['food_kids_ticket'];
                    $_SESSION['cart'][$id]['food_request'] = $cart_item['food_request'];
                }
                else if(empty($_SESSION['cart'][$id]['food_regular_ticket']))
                {
                    $_SESSION['cart'][$id]['food_regular_ticket'] = $cart_item['food_regular_ticket'];
                    $_SESSION['cart'][$id]['food_kids_ticket'] += $cart_item['food_kids_ticket'];
                    $_SESSION['cart'][$id]['food_request'] = $cart_item['food_request'];
                }
                else if(empty($_SESSION['cart'][$id]['food_kids_ticket']))
                {
                    $_SESSION['cart'][$id]['food_regular_ticket'] += $cart_item['food_regular_ticket'];
                    $_SESSION['cart'][$id]['food_kids_ticket'] = $cart_item['food_kids_ticket'];
                    $_SESSION['cart'][$id]['food_request'] = $cart_item['food_request'];
                }
                else {
                    $_SESSION['cart'][$id]['food_regular_ticket'] += $cart_item['food_regular_ticket'];
                    $_SESSION['cart'][$id]['food_kids_ticket'] += $cart_item['food_kids_ticket'];
                    $_SESSION['cart'][$id]['food_request'] = $cart_item['food_request'];
                }
            }
            $this->info($restaurant);

            echo "
            <div id='continueReservationPanel'>
            <img style='margin-left: 20px; height='110px' width='110px' src='".URLROOT."/img/cart.png'>
            <p style='float: right; width: 570px'>Ticket(s) has succesfully been added to your shopping cart. Would you like to continue the reservation and pay?</p>
            <br><br><br>
            <button onclick=window.location.href='".URLROOT."/food/info/".$restaurant."'>Stay</button>
            <button onclick=window.location.href='".URLROOT."/cart/index'>Continue reservation</button>
            </div>          
            ";
        }
    }
}
?>