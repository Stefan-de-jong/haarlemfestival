<?php
class Dance extends Controller{
        public function __construct(){
        $this->danceModel = $this->model('Dance');
        $this->danceRepository = $this->repo('DanceRepository');
    }

    public function dance_purchase(){
        $data = [
            'title' => 'dance'
        ];

        $this->view('pages/dance/dance_purchase', $data);
     }

    public function dance(){
    $data = [
        'title' => 'dance'
    ];

    $this->view('pages/dance/dance_info', $data);
    }
}