<?php
    class Jazz extends Controller{
        public function __construct(){
            $this->JazzRepo = $this->repo('JazzRepository');
            $this->JazzModel = $this->model('Jazz');   
        }

        public function jazz(){
            $data = [
                'title' => 'Jazz main page'
            ];

            $this->view('pages/jazz/index', $data);
        }

        public function jazztickets(){
            $data = [
                'title' => 'Jazz tickets'
            ];

            $this->view('pages/jazz/day', $data);
        }

        public function jazzticketorder(){
            $data = [
                'title' => 'Jazz ticket order'
            ];

            $this->view('pages/jazz/popup', $data);
        }



    }
?>