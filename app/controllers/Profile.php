<?php
class Profile extends Controller
{
    public function __construct()
    {
        $this->profileRepository = $this->repo('ProfileRepository');
        $this->favoriteModel = $this->model('Favorite');

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
        $tickets = $this->profileRepository->getAllUsersTickets($_SESSION['customer_email']);
        $data = [
            'content' => "ticket",
            'ticket' => $tickets

        ];

        $this->view('pages/profile', $data);
    }
    public function favorite()
    {
        $data = [
            'content' => "favorite"

        ];

        $this->view('pages/profile', $data);
    }
}
?>