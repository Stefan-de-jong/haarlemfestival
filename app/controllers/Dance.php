<?php
class Dance extends Controller{

    public function __construct()
    {   $this->danceModel = $this->model('Artist');
        $this->danceModel = $this->model('Venue');
        $this->danceModel = $this->model('EventData');
        $this->danceModel = $this->model('Styles');
        $this->eventModel = $this->model('Event');
        $this->eventModel = $this->model('Pass');
        $this->danceEventModel = $this->model('DanceEvent');
        $this->DanceRepository = $this->repo('DanceRepository');
        $this->snippetModel = $this->model('Snippet');
        $this->snippetRepo = $this->repo('SnippetRepository');
        $this->favoriteRepository = $this->repo('FavoriteRepository');
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

        $snippets = $this->snippetRepo->findByPage('haarlem_dance');
        $data =[
            'title' => 'dance',
            'snippets' => $snippets
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
            $passes = $this->DanceRepository->getAllPasses();

            $data =[
                'title' => 'newticket',
                'passes' => $passes
            ];
    
        $this->view('pages/dance/inc/newticket', $data);
        }

        public function newfavorite()
        {
            $favorite = $this->repo('FavoriteRepository');
            $data =[
                'title' => 'newfavorite',
                'favorite' => $favorite
            ];
    
        $this->view('pages/dance/inc/newfavorite', $data);
        }
    }