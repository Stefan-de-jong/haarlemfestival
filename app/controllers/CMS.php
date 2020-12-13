<?php
 class CMS extends Controller{
    public function __construct()
    {
        $this->repo = $this->repo('CMSRepo');
        $this->model = $this->model('User');
        $this->customerModel = $this->model('Customer');
        $this->model('FormattedSnippet');
    }
    private function CMSLogin() {return 'CMS/login';}
    private function CMSHome() {return 'CMS/home';}
     private function CMSUsers() {return 'CMS/users';}
     private function CMSUser() {return 'CMS/user';}
     private function CMSTickets() {return 'CMS/tickets';}
     private function CMSContent() {return 'CMS/content';}
     private function CMSCustomers() {return 'CMS/customers';}
     private function CMSCustomer() {return 'CMS/customer';}
     private function CMSResetpassword() {return 'CMS/resetPassword';}
     private function CMSEvents() {return 'CMS/Events';}


     private function setLoggedIn($user){
        $_SESSION['CMSLoggedIn'] = true;
        $_SESSION['CMSid'] = $user->id;
        $_SESSION['CMSfn'] = $user->firstname;
        $_SESSION['CMSln'] = $user->lastname;
        $_SESSION['CMSem'] = $user->email;
        $_SESSION['CMSpass'] = $user->password;
        $_SESSION['CMSrole'] = $user->role;
    }
    private function getUser(){
        return new User($_SESSION['CMSid'],$_SESSION['CMSfn'],$_SESSION['CMSln'],$_SESSION['CMSem'],$_SESSION['CMSpass'],$_SESSION['CMSrole']);
    }
    private function loggedIn(){
        if(isset($_SESSION['CMSLoggedIn'])) {
            return $_SESSION['CMSLoggedIn'] === true;
        }
    }
    private function isAnyAdmin(){
        return strtolower($_SESSION['CMSrole']) == "admin" or strtolower($_SESSION['CMSrole']) == "superadmin";
    }
    private function redirectToLogin(){
        redirect($this->CMSLogin());
    }
     private function redirectToHome(){
         redirect($this->CMSHome());
     }
     private function redirectToUsers(){
         redirect($this->CMSUsers());
     }
     private function redirectToCustomers(){
         redirect($this->CMSCustomers());
     }
     private function redirectToEvents(){
         redirect($this->CMSEvents());
     }
     private function Authorize(){
        if (!$this->loggedIn()){
          $this->redirectToLogin();
          return false;
            }  else{
            return true;
        }
        }
     public function Users() {
         $editableObj = $this->repo->getEditable('user','id');
         $this->view($this->CMSUsers(), ['content'=>$editableObj]);
     }
     public function Process(){
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
             if ($this->repo->process($_POST)){
                 $goto = explode('haarlemfestival/', $_SERVER['HTTP_REFERER'])[1];
                 redirect($goto);
             }else{
                 die("Error editing data");
             }
         }
     }
    public function home(){
        if ($this->Authorize()){
            $this->view($this->CMSHome());
        }
    }
    public function index(){
        if ($this->loggedIn()){
            $this->redirectToHome();
        }else {
            $this->view('CMS/login');
        }
    }
    public function login(){
        if ($this->loggedIn()){
            $this->redirectToHome();
        }else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST["email"]) and isset($_POST["password"])) {
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    if ($user = $this->repo->login(
                        $_POST["email"],
                        $_POST["password"]
                    )) {
                        $this->setLoggedIn($user);
                        $this->redirectToHome();
                    }else{
                        $this->view($this->CMSLogin());
                    }
                }
            }else{
            $this->view($this->CMSLogin());
        }
    }
    public function logout(){
        session_destroy();
       $this->redirectToLogin();
    }
     private function viewPage($title, $data) {
         $this->view($title, $data);
         die();
     }
    }
?>