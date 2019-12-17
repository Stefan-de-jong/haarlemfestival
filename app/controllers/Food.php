<?php
class Food extends Controller
{
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

        $this->view('pages/food/index', $data);
    
    }

    public function filter()
    {
        $kitchen = $_GET['kitchen'];

        $restaurants = $this->restaurantRepository->findAllRestaurantsBySpecificKitchen($kitchen);

        $data = [
            'restaurants' => $restaurants
        ];

        $this->view('pages/food/index', $data);
    }

    public function info()
    {
        $restaurant = $_GET['restaurant'];

        $page = $this->restaurantRepository->getRestaurantInfoPage($restaurant);
        $events = $this->restaurantRepository->getEventByRestaurant($restaurant);

        $data = [
            'page' => $page,
            'event'=> $events
        ];
        $this->view('pages/food/info', $data);
    }

    public function reservate()
    {
        $restaurant = $_GET['restaurant'];

        $date =$_POST['reservateDate'];
        $session = $_POST['session'];
        $regularTickets = $_POST['regularTickets'];
        $childTickets = $_POST['childTickets'];
        $specialRequest = $_POST['specialRequest'];

        $event = $this->restaurantRepository->getEventByInfo($date, $session, $restaurant);

        $tickets = array();
        for($i = 0; $i < $regularTickets; $i++)
        {
            $ticket =  new Ticket($event->getId(), 1, $event->getPrice());
            array_push($tickets, $ticket);
        }

        for($i = 0; $i < $childTickets; $i++)
        {
            $ticket =  new Ticket($event->getId(), 2, $event->getPrice());
            array_push($tickets, $ticket);
        }

        echo "<h1> De tickets</h1>";
        foreach ($tickets as $ticket) {
            echo "Event id: ".$ticket->getEvent()."<br> Ticket type: ". $ticket->getType(), "<br> Prijs: ".$ticket->getPrice(), "<br> Datum:  ".$date . "<br> <br>";
        }

    }
}
?>