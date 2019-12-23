<?php
class Program extends Controller
{
    public function __construct(){
    $this->programRepository = $this->repo('programRepository');
    $this->eventModel = $this->model('Event');
    $this->foodEventModel = $this->model('FoodEvent');
    }
    public function index()
    {
        $foodEvents = $this->programRepository->findAllFoodEvents();
        $data = [
            'title' => 'Program',
            'foodEvent' => $foodEvents
        ];

        $this->view('pages/program', $data);
    }
}
?>