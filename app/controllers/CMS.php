<?php
 class CMS extends Controller{
    public function __construct()
    {
        $this->repo = $this->repo('CMSRepo');
        $this->model = $this->model('User');
        $this->snippetModel = $this->model('FormattedSnippet');
    }
    private function CMSLogin() {return 'CMS/login';}
    private function CMSHome() {return 'CMS/home';}
     private function CMSUsers() {return 'CMS/users';}
     private function CMSUser() {return 'CMS/user';}
     private function CMSTickets() {return 'CMS/tickets';}
     private function CMSContent() {return 'CMS/content';}

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
    private function redirectToLogin(){
        redirect($this->CMSLogin());
    }
     private function redirectToHome(){
         redirect($this->CMSHome());
     }
     private function Authorize(){
        if (!$this->loggedIn()){
          $this->redirectToLogin();
          return false;
            }  else{
            return true;
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
    public function users(){
            if ($this->Authorize()) {
                $data = [
                    'users' => $this->repo->allUsers()
                ];
                $this->view($this->CMSUsers(), $data);
            }
    }
    public function user(){
            if ($this->Authorize()) {
                $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
                $user = $this->repo->findUser($_GET["id"]);
                $this->view($this->CMSUser(), ['user' => $user]);
            }
    }
    public function Content(){
        if ($this->Authorize()) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $this->view($this->CMSContent(), ["data" => $this->repo->getAllSnippets()]);
            } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $newText = $_POST['newText'];
                $id = $_POST['ID'];
                $cat = $_POST['cat'];
                if ($this->repo->updateContent($cat, $id, $newText)) {
                    $this->view($this->CMSContent(), ["Message" => "uccessfully updated!", "data" => $this->repo->getAllSnippets()]);
                } else {
                    $this->view($this->CMSContent(), ["Message" => "Failed Updating!", "data" => $this->repo->getAllSnippets()]);
                }
            }
        }
    }
    public function Tickets(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET' and $this->Authorize()) {
            $tickets = $this->repo->getTickets();
            $this->view($this->CMSTickets(),['tickets' => $tickets]);
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
                    }
                }
            }else{
            $this->view($this->CMSLogin());
        }
    }
    }
?>