<?php
class Program extends Controller
{
    public function __construct(){
    $this->programRepository = $this->repo('ProgramRepository');
    $this->eventModel = $this->model('Event');
    $this->foodEventModel = $this->model('FoodEvent');
    $this->historicEventModel = $this->model('HistoricEvent');
    $this->danceEventModel = $this->model('DanceEvent');
    }
    public function index()
    {
        $foodEvents = $this->programRepository->findAllFoodEvents();
        $historicEvents = $this->programRepository->findAllHistoricEvents();
        $danceEvents = $this->programRepository->findAllDanceEvents();

        $data = [
            'title' => 'Program',
            'foodEvent' => $foodEvents,
            'historicEvent' => $historicEvents,
            'danceEvent' => $danceEvents
        ];

        $this->view('pages/program', $data);
    }
}
?>