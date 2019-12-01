<?php
class Restaurants extends Controller
{
    public function __construct(){
        $this->restaurantModel= $this->model('Restaurant');
        $this->restaurantRepository = $this->repo('RestaurantRepository');
    }

    public function findAllRestaurants()
    {
        echo "test";
        //$this->restaurantRepository->findAllRestaurants();
    }
}
?>