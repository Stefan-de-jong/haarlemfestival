<?php
class Dance extends Controller{

    public function __construct()
    {
    $this->danceModel = $this->model('Artist');
    $this->DanceRepository = $this->repo('DanceRepository');
    }

    public function purchase()
    {
        $artists = $this->DanceRepository->getAllArtists();
        $events = $this->DanceRepository->getAllEvents();
        $eventdata = $this->DanceRepository->getEventData();
        $venues = $this->DanceRepository->getVenues();
        $styles = $this->DanceRepository->getStyles();
      
        $data =[
            'title' => 'dance purchase',
            'artists' => $artists,
            'events' => $events,
            'eventdata' => $eventdata,
            'venues' => $venues,
            'styles' => $styles
        ];

    $this->view('pages/dance/dance_purchase', $data);
    }

    public function index(){
        $data =[
            'title' => 'dance'
        ];
        $this->view('pages/dance/dance_info', $data);
        }
}