
   <?php 
        class Volunteer extends Controller {
    
    public function index(){
        $data =[
            'title' => 'volunteer'
        ];
        $this->view('pages/volunteer/volunteer', $data);
        }
    }
    ?>
