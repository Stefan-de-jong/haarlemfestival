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
     private function CMSContent() {return 'CMS/content';}
     private function CMSCustomers() {return 'CMS/customers';}
     private function CMSEvents() {return 'CMS/Events';}
     private function CMSVenues() {return 'CMS/EventVenues';}
     private function CMSRestaurants() {return 'CMS/EventRestaurants';}
     private function CMSDancePerformances() {return 'CMS/EventDancePerformances';}
     private function CMSTickets() {return 'CMS/Tickets';}
     private function CMSGuides(){return 'CMS/EventGuides';}

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
    public function EventVenues(){
        if ($this->Authorize()) {
            $editableObj = $this->repo->getEditable('c');
            $this->view($this->CMSVenues(), ['content' => $editableObj]);
        }
    }
     public function EventGuides(){
         if ($this->Authorize()) {
             $editableObj = $this->repo->getEditable('g');
             $this->view($this->CMSGuides(), ['content' => $editableObj]);
         }
     }
     public function EventRestaurants(){
         if ($this->Authorize()) {
             $editableObj = $this->repo->getEditable('d');
             $this->view($this->CMSRestaurants(), ['content' => $editableObj]);
         }
     }
     public function EventDancePerformances(){
         if ($this->Authorize()) {
             $editableObj = $this->repo->getEditable('e');
             $this->view($this->CMSDancePerformances(), ['content' => $editableObj]);
         }
     }
     public function Tickets(){
         if ($this->Authorize()) {
             $editableObj = $this->repo->getEditable('f');
             $this->view($this->CMSTickets(), ['content' => $editableObj]);
         }
     }
    public function Events(){
        if ($this->Authorize()){
            $this->view($this->CMSEvents(),[]);
        }
    }
     public function Users() {
        if ($this->Authorize()) {
            $editableObj = $this->repo->getEditable('a');
            $this->view($this->CMSUsers(), ['content' => $editableObj]);
        }
     }
     public function Customers() {
        if ($this->Authorize()) {
            $editableObj = $this->repo->getEditable('b');
            $this->view($this->CMSCustomers(), ['content' => $editableObj]);
        }
     }
     public function ResetPassword(){
        if ($this->Authorize()){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if (isset($_POST['action']) and isset($_POST['id'])) {
                    $this->repo->resetPassword($_POST['action'],$_POST['id']);
                    $goto = explode('haarlemfestival/', $_SERVER['HTTP_REFERER'])[1];
                    redirect($goto);
                }
            }
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
                     $this->view($this->CMSContent(), ["Message" => "Successfully updated!", "data" => $this->repo->getAllSnippets()]);
                 } else {
                     $this->view($this->CMSContent(), ["Message" => "Failed Updating!", "data" => $this->repo->getAllSnippets()]);
                 }
             }
         }
     }
     public function Process(){
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
             if ($this->repo->process($_POST)){
                 $goto = explode('haarlemfestival/', $_SERVER['HTTP_REFERER'])[1];
                 if (strpos($goto, '?') !== false) {
                     $goto = explode('?',$goto)[0];
                 }
                 redirect($goto."?msg=Edited successfully!");
             }else{
                die("Error editing data");
             }
         }else{
             $this->redirectToHome();
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
           $this->redirectToLogin();
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
            if (isset($_SERVER['QUERY_STRING'])) {
                if (!(strpos($_SERVER['QUERY_STRING'], 'login') !== false))  {
                    $this->redirectToLogin();
                }
            }
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