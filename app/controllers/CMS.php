<?php 
 class CMS extends Controller{
    public function __construct(){
        $this->repo = $this->repo('UserRepository');
        $this->model = $this->model('User');
    }
    
    public function exists($param){
        return isset($_POST[$param]) || isset($_GET[$param]);
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
            $user = $this->repo->login($data['email'],$data['password']);
            if ($user ===false){
                //Login failed
                $this->view('CMS/login');
            }else{
                //login success
                $_SESSION["cms_id"] = $user->id;
                $_SESSION["cms_fn"] = $user->firstname;
                $_SESSION["cms_ln"] = $user->lastname;
                $_SESSION["cms_em"] = $user->email;
                $_SESSION["cms_pw"] = $user->password;
                $_SESSION["cms_role"] = $user->role;
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

    public function users(){
        if($_SERVER['REQUEST_METHOD']=== 'GET'){
        $data = [
            'title' => 'Manage Users'
        ];

        $this->view('CMS/users', null);
    }
    else if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $params =[$this->exists("fn") ? trim($_POST['fn']) : null,$this->exists("ln") ? trim($_POST['ln']) : null,$this->exists("id") ? trim($_POST['id']) : null,
            $this->exists("em") ? trim($_POST['em']) : null
            ];
        //serach users
        $users = $this->repo->findUsers($params);
        if (!$users===false){
            $this->view('CMS/users', $users);
        }else{
            $this->view('CMS/users', null);
        }
        }
    }

    public function user(){
        if($_SERVER['REQUEST_METHOD']=== 'GET'){
            $data = [
                'title' => 'View User'
            ];
            if ($this->exists("id")){
                $user = $this->repo->findById(addslashes($_GET["id"]));
                if ($user==false){
                    $this->view('CMS/home', $data);
                }else{
                    $this->view('CMS/user', $user);
                }
            }else{
                $this->view('CMS/home', $data);
            }
        }else if ($_SERVER['REQUEST_METHOD']=== 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $params =[$this->exists("fn") ? trim($_POST['fn']) : null,$this->exists("ln") ? trim($_POST['ln']) : null,$this->exists("id") ? trim($_POST['id']) : null,
            $this->exists("em") ? trim($_POST['em']) : null,$this->exists("role") ? trim($_POST['role']) : null
            ];
        //edit user
        $edit = $this->repo->updateUser($params);
        if ($edit===false){
            //update fail
            $this->view('CMS/home', null);
        }else{
            //update success
            $this->view('CMS/users', null);
        }
        }
        }
    }

    
 
?>