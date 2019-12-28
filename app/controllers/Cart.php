<?php
class Cart extends Controller{
    public function __construct(){   
        $this->cartitemRepo = $this->repo('CartItemRepository');
        $this->cartitemModel = $this->model('CartItem');
        $this->historicItemModel = $this->model('HistoricCartItem');
        $this->foodModel = $this->model('FoodCartItem');
    }

    public function index()
    {
        $this->getCartItems('cart');
    }

    public function payment()
    {
        $this->getCartItems('payment');
    }

    private function getCartItems($page)
    {
        $cart_items = [];
        // if session cart doesn't exist, create it
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }

        if(count($_SESSION['cart'])>0){
            $ids = array();
            foreach ($_SESSION['cart'] as $id => $value) {
                array_push($ids, $id);
            }
            foreach ($ids as $id){
                // creating cart items for historic single tickets (if set)
                if(!empty($_SESSION['cart'][$id]['historic_single_ticket'])){
                    $nSingle = $_SESSION['cart'][$id]['historic_single_ticket'];
                    $type = 'historic_single_ticket';
                    $cart_item = $this->cartitemRepo->findHistoric($id, $nSingle, $type);
                    $cart_items[] = $cart_item;
                }
                // creating cart items for historic family tickets (if set)
                if(!empty($_SESSION['cart'][$id]['historic_fam_ticket'])){
                    $nFamily = $_SESSION['cart'][$id]['historic_fam_ticket'];
                    $type = 'historic_fam_ticket';
                    $cart_item = $this->cartitemRepo->findHistoric($id, $nFamily, $type);
                    $cart_items[] = $cart_item;
                }

                //Food regular
                if(!empty($_SESSION['cart'][$id]['food_regular_ticket'])){
                    $regular_tickets = $_SESSION['cart'][$id]['food_regular_ticket'];
                    $request = $_SESSION['cart'][$id]['food_request'];
                    $type = 'food_regular';
                    $cart_item = $this->cartitemRepo->findFood($id, $regular_tickets, $type, $request);
                    $cart_items[] = $cart_item;
                }
                //food kids
                if(!empty($_SESSION['cart'][$id]['food_kids_ticket'])){
                    $kids_tickets = $_SESSION['cart'][$id]['food_kids_ticket'];
                    $request = $_SESSION['cart'][$id]['food_request'];
                    $type = 'food_kids';
                    $cart_item = $this->cartitemRepo->findFood($id, $kids_tickets, $type, $request);
                    $cart_items[] = $cart_item;
                }

                // creating cart items for dance tickets (if set)
                //dance
                //dance
                //dance
            }
            $data = [
                'title' => 'Shopping Cart',
                'cart_items' => $cart_items
            ];
            $this->view('pages/'.$page, $data);
        }
        $this->view('pages/'.$page);
    }
}
?>