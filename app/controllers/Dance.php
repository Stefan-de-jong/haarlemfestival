<?php
class Dance extends Controller{

    public function __construct()
    {
    $this->danceModel = $this->model('Artist');
    $this->DanceRepository = $this->repo('DanceRepository');
    }

    public function purchase()
    {
        $artists = $this->DanceRepository->getAllArtists();
      
        $data =[
            'title' => 'dance purchase',
            'artists' => $artists
        ];

    $this->view('pages/dance/dance_purchase', $data);
    }

    public function index(){
        $data =[
            'title' => 'dance'
        ];
        $this->view('pages/dance/dance_info', $data);
        }
}