<?php
    class Historic extends Controller{
        public function __construct(){
            $this->locationRepo = $this->repo('LocationRepository');
            $this->locationModel = $this->model('Location');
            $this->tourRepo = $this->repo('TourRepository');
            $this->tourModel = $this->model('Tour');      
        }

        public function index(){
            $locations = $this->locationRepo->findAll();
            
            $data = [
                'title' => 'Historic tour',
                'locations' => $locations
            ];

            $this->view('historic/tour', $data);
        }

        public function about(){
            $data = [
                'title' => 'About Haarlem'
            ];

            $this->view('historic/about', $data);
        }

        public function tickets($date = '2020-07-24'){            
            
            $events = $this->tourRepo->findByDate($date);            
            
            $data = [
                'title' => 'Historic Tickets',
                'events' => $events                
            ];

            $this->view('historic/tickets', $data);
        }



    }
?>