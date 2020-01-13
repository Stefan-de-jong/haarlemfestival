<?php
class Program extends Controller
{
    public function __construct(){
    $this->programRepository = $this->repo('ProgramRepository');
    $this->favoriteRepository = $this->repo('FavoriteRepository');
    $this->eventRepository = $this->repo('eventRepository');

    $this->eventModel = $this->model('Event');
    $this->foodEventModel = $this->model('FoodEvent');
    $this->historicEventModel = $this->model('HistoricEvent');

    $this->profileRepository = $this->repo('ProfileRepository');
    $this->favoriteModel = $this->model('Favorite');
    $this->foodFavoriteModel = $this->model('FoodFavorite');
    $this->historicFavoriteModel = $this->model('HistoricFavorite');
    }
    public function index()
    {
        //prevent error. user with id 0 is default user.
        if(empty($_SESSION['customer_id']))
            $customer = 0;
        else
            $customer = $_SESSION['customer_id'];

        $foodFavorites = $this->favoriteRepository->getAllFoodFavorites($customer);
        $historicFavorites = $this->favoriteRepository->getAllHistoricFavorites($customer);

        $foodEvents = $this->eventRepository->findAllFoodEvents();
        $historicEvents = $this->eventRepository->findAllHistoricEvents();
        $data = [
            'title' => 'Program',
            'foodEvent' => $foodEvents,
            'historicEvent' => $historicEvents,
            'foodFavorite' => $foodFavorites,
            'historicFavorite' => $historicFavorites
        ];
        $this->view('pages/program', $data);
    }
}
?>