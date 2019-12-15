<?php
    class Jazz extends Controller{
        
        public function __construct(){
            $this->JazzRepository = $this->repo('JazzRepository');
            $this->ArtistModel = $this->model('Artist');   
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
                'title' => 'Jazz ticket order',
                'ticketinfo' => $this->getSelectedTicket()
            ];

            $this->view('pages/jazz/popup', $data);
        }

        public function artists()
        {
            $data = [
                'title' => 'Jazz artists',
                'artistlist' => $this->loadJazzArtists()
            ];

            $this->view('pages/jazz/artistfind', $data);
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
            
            if ($day != 2)
            {
                return $this->JazzRepository->getEventsByDate($day);
            }
            else
            {
                return $this->JazzRepository->getArtistTable($_GET['artist']);
            }
        }

        public function getSelectedTicket()
        {
            return $this->JazzRepository->getTicket($_GET['eventid']);
        }

        public function loadJazzArtists()
        {
            return $this->JazzRepository->getArtistNames();
        }

        public function getImage1()
        {
            //WIP
        }
    }
?>