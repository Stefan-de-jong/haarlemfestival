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
        public function CMS_home(){
            $data = [
                'title' => 'Volunteer Login'
            ];

            $this->view('pages/CMS/home', $data);
        }

        public function CMS_content(){
            $data = [
                'title' => 'Volunteer Login'
            ];

            $this->view('pages/CMS/content', $data);
        }
       
        public function CMS_testpage1(){
            $data = [
                'title' => 'Content Manager'
            ];

            $this->view('pages/CMS/Content_testpages/test1', $data);
        }
       

        public function food(){
            $data = [
                'title' => 'Restaurant overview'
            ];

            $this->view('pages/food/index', $data);
        }

        public function foodInfo(){
            $data = [
                'title' => 'Restaurant info'
            ];

            $this->view('pages/food/info', $data);
        }
    }
?>