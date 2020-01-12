<?php
    class Historic extends Controller{
        public function __construct(){
            $this->locationRepo = $this->repo('LocationRepository');
            $this->locationModel = $this->model('Location');
            $this->tourRepo = $this->repo('TourRepository');
            $this->eventModel = $this->model('Event');
            $this->historicEventModel = $this->model('HistoricEvent');
            $this->favoriteRepository = $this->repo('FavoriteRepository');
            $this->snippetModel = $this->model('Snippet');
            $this->snippetRepo = $this->repo('SnippetRepository');
        }

        public function index(){
            $locations = $this->locationRepo->findAll();
            $snippets = $this->snippetRepo->findByPage('haarlem_route');            
            $data = [
                'title' => 'Historic tour',
                'locations' => $locations,
                'snippets' => $snippets
            ];

            $this->view('historic/tour', $data);
        }

        public function about(){
            $snippets = $this->snippetRepo->findByPage('haarlem_about');
            $data = [
                'title' => 'About Haarlem',
                'snippets' => $snippets
            ];

            $this->view('historic/about', $data);
        }
        
        public function tickets(){            
            if(isset($_GET['tourdate'])){
                $tourdate = $_GET['tourdate'];
            } else{
                $tourdate = '2020-07-24';
            }
            
            $tours = $this->tourRepo->findByDate($tourdate);            
        
            $data = [
                'title' => 'Tickets',
                'tours' => $tours                
            ];

            $this->view('historic/tickets', $data);
        }

        public function order(){                                      
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data =[
                'tour_date' => trim($_POST['selected_day']),
                'tour_time' => trim($_POST['selected_time']),
                'tour_language' => trim($_POST['selected_language']),
                'single_tickets' => trim($_POST['selected_singleTickets']),
                'fam_tickets' => trim($_POST['selected_famTickets']),
                'amount_error' => ''
            ];            

            $tour = $this->tourRepo->find($data['tour_date'], $data['tour_time'], $data['tour_language']); // ToDo als gekozen id meegegeven kan worden vanuit tickets page -> zoeken naar ID
            
            if($tour != null){                           
                if(isset($_POST['historicFav'])) {
                    $this->favoriteRepository->addFavorite($_SESSION['customer_id'],$tour->getId());
                    flash('addedToFav_alert', 'Added to favourites', 'alert alert-success');
                    redirect('historic/tickets');
                }
                elseif($data['single_tickets'] == 0 && $data['fam_tickets'] == 0){
                    flash('ticketNotAdded_alert', 'Please select a number of tickets', 'alert alert-danger');
                    redirect('historic/tickets');
                }
                elseif($tour->getNTickets() < ($data['single_tickets']+($data['fam_tickets']*4))){
                    flash('ticketNotAdded_alert', 'Not enough tickets available', 'alert alert-danger');
                    redirect('historic/tickets');
                }
                else{
                    $id = $tour->getId();
                    $n_single = $data['single_tickets'];
                    $n_fam = $data['fam_tickets'];
                    $cart_item = array(
                        'historic_single_ticket' => $n_single,
                        'historic_fam_ticket' => $n_fam
                    );

                    if(!isset($_SESSION['cart'])){
                        $_SESSION['cart'] = array();
                    }

                    if(!array_key_exists($id, $_SESSION['cart'])){
                        $_SESSION['cart'][$id]=$cart_item;
                        flash('ticketAdded_succes', 'Ticket(s) added to cart', 'alert alert-success');
                        redirect('historic/tour');
                    } else {
                        // ToDo check if ordered tickets + cart tickets are nog more then available
                        $_SESSION['cart'][$id]['historic_single_ticket']+=$cart_item['historic_single_ticket'];
                        $_SESSION['cart'][$id]['historic_fam_ticket']+=$cart_item['historic_fam_ticket'];
                        flash('ticketAdded_succes', 'Ticket(s) added to cart', 'alert alert-success');
                        redirect('historic/tour');
                    }
                }                                  
            }                     
        }
    }
?>