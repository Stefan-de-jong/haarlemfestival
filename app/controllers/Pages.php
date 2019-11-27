<?php
    class Pages extends Controller {
        public function __construct(){

        }

        public function index(){
            $data = [
                'title' => 'Haarlem Festival'
            ];

            $this->view('pages/index', $data);
        }

        public function about(){
            $data = [
                'title' => 'About us'
            ];

            $this->view('pages/about', $data);
        }

        public function CMS(){
            $data = [
                'title' => 'Volunteer Login'
            ];

            $this->view('pages/CMS/index', $data);
        }

        public function historic(){
            $data = [
                'title' => 'Historic tour'
            ];

            $this->view('historic/tour', $data);
        }

        public function abouthaarlem(){
            $data = [
                'title' => 'About Haarlem'
            ];

            $this->view('historic/about', $data);
        }
    }
?>