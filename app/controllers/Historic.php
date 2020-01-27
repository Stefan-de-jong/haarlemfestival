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

        public function select(){
            if(isset($_POST['location_id'])){                
                $locationId = filter_var($_POST['location_id'], FILTER_SANITIZE_NUMBER_INT);       

                $output = '';                
                $location = $this->locationRepo->findById($locationId);
                
                $output .= '                    
                        <div class="col d-xl-flex justify-content-xl-center align-items-xl-center">
                            <p class="text-justify">' . $location->getDescription() . '</p>
                        </div>';

                if ($location->getURL1() != '') {
                    $output .= '
                        <div class="col d-xl-flex justify-content-xl-center align-items-xl-center">
                            <img src="' . URLROOT . '\\/img/' . $location->getURL1() . '"
                            class="rounded shadow-sm img-fluid">
                        </div>';
                }

                if ($location->getURL2() != '') {
                    $output .= '
                        <div class="col d-xl-flex justify-content-xl-center align-items-xl-center">
                            <img src="' . URLROOT . '\\/img/' . $location->getURL2() . '"
                            class="rounded shadow-sm img-fluid">
                        </div>';
                }
                echo $output;
            }
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
                $tourdate = '2020-07-23';
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

            switch ($_POST['selected_day']) {
                case '2020-07-23':
                case '2020-07-24':
                case '2020-07-25':
                case '2020-07-26':
                    $selectedDay = (string)trim($_POST['selected_day']);
                    break;                
                default:
                    echo 'Invalid day selection';                    
            }
            switch ($_POST['selected_time']) {
                case '10:00:00':
                case '13:00:00':
                case '16:00:00':
                    $selectedTime = (string)trim($_POST['selected_time']);
                    break;                
                default:
                    echo 'Invalid time selection';                    
            }
            switch ($_POST['selected_language']) {
                case 'Nederlands':
                case 'English':
                case 'Chinese':
                    $selectedLanguage = (string)trim($_POST['selected_language']);
                    break;                
                default:
                    echo 'Invalid language selection';                    
            }
            switch ($_POST['selected_singleTickets']) {
                case 0:
                case 1:
                case 2:
                case 3:
                case 4:
                case 5:
                case 6:
                case 7:
                case 8:
                case 9:
                case 10:
                case 11:
                case 12:
                    $singleTickets = (int)trim($_POST['selected_singleTickets']);
                    break;                
                default:
                    echo 'Invalid language selection';                    
            }
            switch ($_POST['selected_famTickets']) {
                case 0:
                case 1:
                case 2:
                case 3:
                    $famTickets = (int)trim($_POST['selected_famTickets']);
                    break;                
                default:
                    echo 'Invalid language selection';                    
            }            
            $data =[
                'tour_date' => $selectedDay,
                'tour_time' => $selectedTime,
                'tour_language' => $selectedLanguage,
                'single_tickets' => $singleTickets,
                'fam_tickets' => $famTickets       
            ];                        
            $tour = $this->tourRepo->find($data['tour_date'], $data['tour_time'], $data['tour_language']);
            
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
                        $_SESSION['cart'][$id]['historic_single_ticket']+=$cart_item['historic_single_ticket'];
                        $_SESSION['cart'][$id]['historic_fam_ticket']+=$cart_item['historic_fam_ticket'];
                        flash('ticketAdded_succes', 'Ticket(s) added to cart', 'alert alert-success');
                        redirect('historic/tour');
                    }
                }                                  
            }else{
                flash('tourNotFound_alert', 'This tour is no longer available', 'alert alert-danger');
                redirect('historic/tickets');
            }
        }
    }
?>