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
        public function CMS_home(){
            $data = [
                'title' => 'Volunteer Home'
            ];

            $this->view('pages/CMS/home', $data);
        }
        public function CMScontent(){
            $data = [
                'title' => 'Content Manager'
            ];

            $this->view('pages/CMS/content', $data);
        }
        public function CMStest1(){
            $data = [
                'title' => 'Content Manager'
            ];

            $this->view('pages/CMS/Content_testpages/test1', $data);
        }
        public function CMStest2(){
            $data = [
                'title' => 'Content Manager'
            ];

            $this->view('pages/CMS/Content_testpages/test2', $data);
        }
       
    }
?>