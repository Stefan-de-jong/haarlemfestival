<?php
class Profile extends Controller
{
    public function __construct()
    {       
        $this->ticketRepository = $this->repo('TicketRepository');
        $this->favoriteRepository = $this->repo('FavoriteRepository');

        $this->favoriteModel = $this->model('Favorite');
        $this->ffavoriteModel = $this->model('FoodFavorite');
        $this->hfavoriteModel = $this->model('HistoricFavorite');

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
        $foodTickets = $this->ticketRepository->getAllFoodTickets($_SESSION['customer_email']);
        $historicTickets = $this->ticketRepository->getAllHistoricTickets($_SESSION['customer_email']);
        //$danceTickets = $this->ticketRepository->getAllDanceTickets($_SESSION['customer_email']);
        $data = [
            'content' => "ticket",
            'foodTicket' => $foodTickets,
            'historicTicket' => $historicTickets
            //'danceTicket' => $danceTickets
        ];
        $this->view('pages/profile', $data);
    }
    public function favorite()
    {
        $foodFavorites = $this->favoriteRepository->getAllFoodFavorites($_SESSION['customer_id']);
        $historicFavorites = $this->favoriteRepository->getAllHistoricFavorites($_SESSION['customer_id']);

        $data = [
            'content' => "favorite",
            'foodFavorite' => $foodFavorites,
            'historicFavorite' => $historicFavorites
        ];
        $this->view('pages/profile', $data);
    }
    public function deleteFavorite($event)
    {
        $this->favoriteRepository->deleteFavorite($_SESSION['customer_id'], $event);
        $this->favorite();
    }
}
?>