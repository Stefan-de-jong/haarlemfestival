<?php
class Cart extends Controller
{
    public function index()
    {
        if(count($_SESSION['cart'])>0){
            $ids = array();
            foreach ($_SESSION['cart'] as $id => $value) {
                array_push($ids, $id);
            }
        }
        // cartrepo opzetten
        // foreach id in ids cartitems aanmaken (quantity komt uit session etc)
        // cartitems doorgeven naar cart page
           

        $this->view('pages/cart');
    }
}

?>