<?php 
 class CMS extends Controller{
    public function __construct(){
        $this->repo = $this->repo('UserRepository');
        $this->model = $this->model('User');
    }

    public function index(){
        if($_SERVER['REQUEST_METHOD']=== 'GET'){
        $this->view('CMS/login');
        }
        else if ($_SERVER['REQUEST_METHOD']=== 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data =[
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
            ];
            //attempt login
            if ($user = $this->repo->login($data['email'],$data['password'])===false){
                //Login failed
                $this->view('CMS/login');
            }else{
                //login success
                $this->view('CMS/home');
            }
            
        }
    }
    public function home(){
        $data = [
            'title' => 'CMS Home'
        ];

        $this->view('CMS/home', $data);
    }

    public function content(){
        $data = [
            'title' => 'Content Management'
        ];

        $this->view('CMS/content', $data);
    }
 }
?>