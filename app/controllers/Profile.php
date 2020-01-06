<?php
class Profile extends Controller
{
    public function __construct()
    {
        $this->profileRepository = $this->repo('ProfileRepository');
        $this->favoriteModel = $this->model('Favorite');
        $this->ffavoriteModel = $this->model('FoodFavorite');

        $this->ticketModel = $this->model('Ticket');
        $this->hticketModel = $this->model('HistoricTicket');
        $this->fticketModel = $this->model('FoodTicket');
        $this->dticketModel = $this->model('DanceTicket');
    }

    public function index()
    {
        $data = [
            'content' => "index"

        ];

        $this->view('pages/profile', $data);
    }
    public function ticket()
    {
        $foodTickets = $this->profileRepository->getAllFoodTickets($_SESSION['customer_email']);
        //$historicTickets = $this->profileRepository->getAllHistoricTickets($_SESSION['customer_email']);
        //$danceTickets = $this->profileRepository->getAllDanceTickets($_SESSION['customer_email']);
        $data = [
            'content' => "ticket",
            'foodTicket' => $foodTickets
            //'historicTicket' => $historicTickets,
            //'danceTicket' => $danceTickets
        ];

        $this->view('pages/profile', $data);
    }
    public function favorite()
    {
        $foodFavorites = $this->profileRepository->getAllFoodFavorites($_SESSION['customer_id']);

        $data = [
            'content' => "favorite",
            'foodFavorite' => $foodFavorites
        ];

        $this->view('pages/profile', $data);
    }
}
?>