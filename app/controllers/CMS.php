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
            $editableObj = $this->repo->getEditable('d9729feb74992cc3482b350163a1a010');
            $addObj = $this->repo->getAddable('d9729feb74992cc3482b350163a1a010');
            $this->view($this->CMSVenues(), ['editing' => $editableObj,'adding'=>$addObj]);
        }
    }
     public function EventGuides(){
         if ($this->Authorize()) {
             $editableObj = $this->repo->getEditable('a1df5dde9402fb786e7efa94d6f851ca');
             $this->view($this->CMSGuides(), ['editing' => $editableObj]);
         }
     }
     public function EventRestaurants(){
         if ($this->Authorize()) {
             $editableObj = $this->repo->getEditable('6155ea87c23c52518df731aaa1f635aa');
             $this->view($this->CMSRestaurants(), ['editing' => $editableObj]);
         }
     }
     public function EventDancePerformances(){
         if ($this->Authorize()) {
             $editableObj = $this->repo->getEditable('7cda127b9c7c0fa6430b710f04d0b08f');
             $this->view($this->CMSDancePerformances(), ['editing' => $editableObj]);
         }
     }
     public function Tickets(){
         if ($this->Authorize()) {
             $editableObj = $this->repo->getEditable('e0fe3095d33d3e33b253cb495ef3ba3f');
             $this->view($this->CMSTickets(), ['editing' => $editableObj]);
         }
     }
    public function Events(){
        if ($this->Authorize()){
            $this->view($this->CMSEvents(),[]);
        }
    }
     public function Users() {
        if ($this->Authorize()) {
            $editableObj = $this->repo->getEditable('d58e3582afa99040e27b92b13c8f2280');
            $addableObj = $this->repo->getAddable('d58e3582afa99040e27b92b13c8f2280');
            $this->view($this->CMSUsers(), ['editing' => $editableObj,'adding'=>$addableObj]);
            //test
        }
     }
     public function Customers() {
        if ($this->Authorize()) {
            $editableObj = $this->repo->getEditable('f4b1df7d1d45beb8f5529899393307a9');
            $addableObj = $this->repo->getAddable('f4b1df7d1d45beb8f5529899393307a9');
            $this->view($this->CMSCustomers(), ['editing' => $editableObj,'adding'=>$addableObj]);
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
         if ($_SERVER['REQUEST_METHOD'] === 'POST' and $this->Authorize()) {
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
     public function AddObject(){
         if ($_SERVER['REQUEST_METHOD'] === 'POST' and $this->Authorize()) {
             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
             $msg = '';
             if ($this->repo->addObject($_POST)){
                 $msg = 'Added succesfully!';
             }else{
                 $msg = 'Error adding object!';
             }
             $goto = explode('haarlemfestival/', $_SERVER['HTTP_REFERER'])[1];
             if (strpos($goto, '?') !== false) {
                 $goto = explode('?',$goto)[0];
             }
             redirect($goto."?msg={$msg}");
         }else{
             $this->redirectToHome();
         }
     }
     public function DeleteObject(){
         if ($_SERVER['REQUEST_METHOD'] === 'POST' and $this->Authorize()) {
             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
             $msg = '';
             if ($this->repo->deleteObject($_POST)){
                 $msg = 'Deleted succesfully!';
             }else{
                 $msg = 'Error deleting object!';
             }
             $goto = explode('haarlemfestival/', $_SERVER['HTTP_REFERER'])[1];
             if (strpos($goto, '?') !== false) {
                 $goto = explode('?',$goto)[0];
             }
             redirect($goto."?msg={$msg}");
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