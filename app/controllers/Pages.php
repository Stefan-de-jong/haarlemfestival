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

        public function dance(){
        $data = [
            'title' => 'dance'
        ];

        $this->view('pages/dance/info_page/dance_info', $data);
    }

    public function dance_purchase(){
        $data = [
            'title' => 'dance'
        ];

        $this->view('pages/dance/purchase_page/dance_purchase', $data);
    }
}
?>