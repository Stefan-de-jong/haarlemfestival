<?php
class Program extends Controller
{
    public function __construct(){
    $this->programRepository = $this->repo('programRepository');
    $this->eventModel = $this->model('Event');
    $this->foodEventModel = $this->model('FoodEvent');
    $this->historicEventModel = $this->model('HistoricEvent');
    }
    public function index()
    {
        $foodEvents = $this->programRepository->findAllFoodEvents();
        $historicEvents = $this->programRepository->findAllHistoricEvents();
        $data = [
            'title' => 'Program',
            'foodEvent' => $foodEvents,
            'historicEvent' => $historicEvents
        ];

        $this->view('pages/program', $data);
    }
}
?>