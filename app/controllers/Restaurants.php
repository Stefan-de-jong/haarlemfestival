<?php
class Restaurants extends Controller
{
    public function __construct(){
        $this->restaurantModel= $this->model('Restaurant');
        $this->restaurantRepository = $this->repo('RestaurantRepository');
    }

    public function index()
    {
        
        $restaurants = $this->restaurantRepository->findAllRestaurants();

        $data = [
            'restaurants' => $restaurants
        ];

        $this->view('pages/food/info', $data);
    
    }
}
?>