<?php
    class Historic extends Controller{
        public function __construct(){
            $this->locationRepo = $this->repo('LocationRepository');
            $this->locationModel = $this->model('Location');   
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

        public function tickets(){
            $data = [
                'title' => 'Historic Tickets'
            ];

            $this->view('historic/tickets', $data);
        }



    }
?>