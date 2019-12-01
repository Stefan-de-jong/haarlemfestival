<?php
class Restaurants extends Controller
{
    public function __construct(){
        $this->restaurantModel = $this->model('RestaurantRepository');
    }

    public function findAllRestaurants()
    {
        return "<br> tetsstststsststtstst";
        //$this->restaurantModel->findAllRestaurants();
    }
}
?>