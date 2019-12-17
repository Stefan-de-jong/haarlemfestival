<?php
class Cart extends Controller
{
    public function __construct(){                
        // $this->tourRepo = $this->repo('TourRepository');
        // $this->tourModel = $this->model('Tour');      
        $this->cartitemRepo = $this->repo('CartItemRepository');
        $this->cartitemModel = $this->model('CartItem');      
    }

    public function index()
    {
        $cart_items = [];
        // if session cart niet bestaat, maken
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }

        if(count($_SESSION['cart'])>0){
            $ids = array();
            foreach ($_SESSION['cart'] as $id => $value) {
                array_push($ids, $id);
            }
            foreach ($ids as $id){
                // is single niet leeg? dan single cart item aanmaken
                if(!empty($_SESSION['cart'][$id]['historic_single_ticket'])){                    
                    $nSingle = $_SESSION['cart'][$id]['historic_single_ticket'];
                    $type = 'historic_single_ticket';
                    $cart_item = $this->cartitemRepo->findById($id, $nSingle, $type);
                    $cart_items[] = $cart_item;
                }                
                // is fam niet leeg? dan fam cart item aanmaken
                if(!empty($_SESSION['cart'][$id]['historic_fam_ticket'])){                    
                    $nFamily = $_SESSION['cart'][$id]['historic_fam_ticket'];
                    $type = 'historic_fam_ticket';
                    $cart_item = $this->cartitemRepo->findById($id, $nFamily, $type);
                    $cart_items[] = $cart_item;
                }
                // fam cart item toevoegen aan array
                // $singleTickets = $_SESSION['cart'][$id]['single_tickets'];
                // $familyTickets = $_SESSION['cart'][$id]['family_tickets'];

                // flash('ticketAdded_succes', 'Ticket(s) added to cart', 'alert alert-success');
                //  redirect('historic/tour');, $type, $qty);
            }
            $data = [
                'title' => 'Shopping Cart',
                'cart_items' => $cart_items
            ];
            $this->view('pages/cart', $data);
        }           
        $data = [
            'title' => 'Shopping Cart',
            'cart_items' => $cart_items
        ];
        $this->view('pages/cart');
    }
}

?>