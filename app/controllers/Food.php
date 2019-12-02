<?php
class Food extends Controller
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

        $this->view('pages/food/index', $data);
    
    }

    public function filter()
    {
        $kitchen = $_GET['kitchen'];

        $restaurants = $this->restaurantRepository->findAllRestaurantsBySpecificKitchen($kitchen);

        $data = [
            'restaurants' => $restaurants
        ];

        $this->view('pages/food/index', $data);
    }

    public function info()
    {
        $page_nr = $_GET['restaurant'];

        $page = $this->restaurantRepository->getRestaurantInfoPage($page_nr);

        $data = [
            'page' => $page
        ];

        $this->view('pages/food/info', $data);
    }
}
?>