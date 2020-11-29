<?php 
 class CMS extends Controller{
    public function __construct()
    {
        $this->repo = $this->repo('CMSRepo');
        $this->model = $this->model('User');
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
    public function home(){
        if ($this->loggedIn()){
            $this->view($this->CMSHome());
        }else{
            $this->redirectToLogin();
        }
    }
    public function index(){
        $this->redirectToLogin();
    }
    public function users(){
        try {
            if ($this->loggedIn()) {
                $data = [
                    'users' => $this->repo->allUsers()
                ];
                $this->view($this->CMSUsers(), $data);
            }else{
                throw new Exception("Not logged in");
            }
        }
        catch (Exception $e){
            $this->redirectToLogin();
        }
    }
    public function user(){
        try {
            if ($this->loggedIn()) {
                $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
                $user = $this->repo->findUser($_GET["id"]);
                $this->view($this->CMSUser(), ['user' => $user]);
            } else {
                throw new Exception("Not logged in");
            }
        }
        catch (Exception $e){
            $this->redirectToLogin();
        }
    }
    private function getAllSnippets(){
        try {
            $danceSnippets = $this->repo->getDanceSnippets();
            $historicSnippets1 = $this->repo->getHistoricSnippets1();
            $historicSnippets2 = $this->repo->getHistoricSnippets2();
            return ["dance"=>$danceSnippets,"historicMain" => $historicSnippets1,"historicRoute" => $historicSnippets2];
        }catch (Exception $e){
            return [];
        }
    }
    public function Content(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->view($this->CMSContent(),["data"=>$this->getAllSnippets()]);
        }else if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $newText = $_POST['newText'];
            $id=$_POST['ID'];
            $cat=$_POST['cat'];
            if ($this->repo->updateContent($cat,$id,$newText)){
                $this->view($this->CMSContent(),["Message"=>"uccessfully updated!","data"=>$this->getAllSnippets()]);
            }else{
                $this->view($this->CMSContent(),["Message"=>"Failed Updating!","data"=>$this->getAllSnippets()]);
            }
        }
    }
    public function Tickets(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $tickets = $this->repo->getTickets();
            $this->view($this->CMSTickets(),['tickets' => $tickets]);
        }
    }
    public function login(){
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST["email"]) and isset($_POST["password"])) {
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    if ($user = $this->repo->login(
                        $_POST["email"],
                        $_POST["password"]
                    )) {
                        $this->setLoggedIn($user);
                        $this->redirectToHome();
                    }else{
                        throw new Exception("Login Failed");
                    }
                }
            }else{
                $this->view($this->CMSLogin());
            }
        }
        catch (exception $e){
           $this->view($this->CMSLogin());
        }
    }
    }
?>