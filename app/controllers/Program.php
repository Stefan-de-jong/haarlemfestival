<?php
class Program extends Controller
{
    public function __construct(){
    $this->programRepository = $this->repo('ProgramRepository');
    $this->eventModel = $this->model('Event');
    $this->foodEventModel = $this->model('FoodEvent');
    $this->historicEventModel = $this->model('HistoricEvent');

    $this->profileRepository = $this->repo('ProfileRepository');
    $this->favoriteModel = $this->model('Favorite');
    $this->foodFavoriteModel = $this->model('FoodFavorite');
    }
    public function index()
    {
        $foodFavorites = $this->profileRepository->getAllFoodFavorites($_SESSION['customer_id']);
        $foodEvents = $this->programRepository->findAllFoodEvents();
        $historicEvents = $this->programRepository->findAllHistoricEvents();
        $data = [
            'title' => 'Program',
            'foodEvent' => $foodEvents,
            'historicEvent' => $historicEvents,
            'foodFavorite' => $foodFavorites
        ];
        $this->view('pages/program', $data);
    }
}
?>