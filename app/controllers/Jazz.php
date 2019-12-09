<?php
    class Jazz extends Controller{
        
        public function __construct(){
            $this->JazzRepository = $this->repo('JazzRepository');
            //$this->JazzModel = $this->model('Jazz');   
        }

        public function Jazz(){
            $data = [
                'title' => 'Jazz main page'
            ];

            $this->view('pages/jazz/index', $data);
        }

        public function jazztickets(){
            $data = [
                'title' => 'Jazz tickets',
                'tickets' => $this->loadTickets()
            ];

            $this->view('pages/jazz/day', $data);
        }

        public function jazzticketorder(){
            $data = [
                'title' => 'Jazz ticket order'
            ];

            $this->view('pages/jazz/popup', $data);
        }

        public function loadTickets()
        {
            $day = 2;
            if(isset($_POST["thursday"])) {
                $day = "2018-07-26";
            }
            if(isset($_POST["friday"])) {
                $day =  "2018-07-27";
            }
            if(isset($_POST["saturday"])) {
                $day = "2018-07-28";
            } 
            if(isset($_POST["sunday"])) {
                $day = "2018-07-29";
            }
            $array = explode("-", $day); 
            
            return $this->JazzRepository->getEventsByDate($day);
        }
    }
?>