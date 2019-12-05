<?php
class Food extends Controller
{
    public function __construct(){
        $this->restaurantModel= $this->model('Restaurant');
        $this->ticketModel= $this->model('Ticket');
        $this->restaurantRepository = $this->repo('RestaurantRepository');
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
        $event = $this->restaurantRepository->getEventInfo($restaurant);

        $data = [
            'page' => $page,
            'event'=> $event
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
            $ticket =  new Ticket($event[0]->id, 1, $event[0]->price);
            array_push($tickets, $ticket);
        }

        for($i = 0; $i < $childTickets; $i++)
        {
            $ticket = new Ticket($event[0]->id, 2, $event[0]->price);
            array_push($tickets, $ticket);
        }

        foreach ($tickets as $ticket) {
            echo $ticket->getEvent(), $ticket->getType(), $ticket->getPrice() . "<br>";
        }

    }
}
?>