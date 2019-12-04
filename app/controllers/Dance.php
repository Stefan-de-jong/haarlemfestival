<?php
class Dance extends Controller{

    public function __construct()
    {
    $this->danceModel = $this->model('Artist');
    $this->DanceRepository = $this->repo('DanceRepository');
    }

    public function dance_purchase()
    
        $artists = $this->DanceRepository->getAllArtists();
      
        $data = [
            'artist' => $artists;
        ];

    echo 'test';
    $this->view('pages/dance/dance_purchase', $data);
    
}