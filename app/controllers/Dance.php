<?php
class Dance extends Controller{

    public function __construct()
    {   $this->danceModel = $this->model('Artist');
        $this->danceModel = $this->model('Venue');
        $this->danceModel = $this->model('EventData');
        $this->danceModel = $this->model('Styles');
        $this->eventModel = $this->model('Event');
        $this->danceEventModel = $this->model('DanceEvent');
        $this->DanceRepository = $this->repo('DanceRepository');
    }

    public function purchase()
    {
        $artists = $this->DanceRepository->getAllArtists();
      
        $data =[
            'title' => 'dance purchase',
            'artists' => $artists
        ];

    $this->view('pages/dance/dance_purchase', $data);
    }

    public function index(){
        $data =[
            'title' => 'dance'
        ];
        $this->view('pages/dance/dance_info', $data);
        }

        public function panel(){
        
        $artists = $this->DanceRepository->getAllArtists();
        $events = $this->DanceRepository->getAllEvents();
        $eventdata = $this->DanceRepository->getEventData();
        $venues = $this->DanceRepository->getVenues();
        $styles = $this->DanceRepository->getStyles();
        
        {
            $data =[
                'title' => 'panel',
                'artists' => $artists,
                'events' => $events,
                'eventdata' => $eventdata,
                'venues' => $venues,
                'styles' => $styles
            ];
            $this->view('pages/dance/inc/panel', $data);
            }
        }

        public function newticket()
        {
          
            $data =[
                'title' => 'newticket',
            ];
    
        $this->view('pages/dance/inc/newticket', $data);
        }
    }