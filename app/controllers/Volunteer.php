
   <?php 
        class Volunteer extends Controller {
    public function __construct()
    {
        $this->snippetRepo = $this->repo('SnippetRepository');
    }

            public function index(){
        $data =[
            'title' => 'volunteer',
            'content' => $this->snippetRepo->volunteerSnippet()
        ];
        $this->view('pages/volunteer/volunteer', $data);
        }
    }
    ?>
