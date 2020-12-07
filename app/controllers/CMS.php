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
    public function events(){
        if ($this->Authorize()) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $this->view($this->CMSEvents(), ["events" => $this->repo->getEvents() or die("Error getting events")]);
            } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $newText = $_POST['newText'];
                $id = $_POST['ID'];
                $cat = $_POST['cat'];
                if ($this->repo->updateContent($cat, $id, $newText)) {
                    $this->view($this->CMSEvents(), ["Message" => "Successfully updated!", "data" => $this->repo->getAllSnippets()]);
                } else {
                    $this->view($this->CMSEvents(), ["Message" => "Failed Updating!", "data" => $this->repo->getAllSnippets()]);
                }
            }
        }
    }
     public function users(){
         if ($this->Authorize()) {
             if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                 $users = $this->repo->findUsers();
                 $this->view($this->CMSUsers(), ['title' => 'Manage Users','users'=> $users]);
             }
         }
     }
    public function user(){
            if ($this->Authorize()) {
                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    if (isset($_GET["id"])) {
                        try {
                            if (!($_GET["id"] === $_SESSION["CMSid"])) {
                                if (!$this->isAnyAdmin()) {
                                    $this->redirectToHome();
                                }
                            }
                            $targetuser = $this->repo->findById($_GET["id"]);
                            $targetUserRole = array_search(strtolower($targetuser->getRole()),["user","admin","superadmin"]);
                            $currentUserRole = array_search(strtolower($_SESSION["CMSrole"]),["user","admin","superadmin"]);
                            if ($currentUserRole===2){
                                //superuser bekijkt/edit iemand
                                $this->viewPage($this->CMSUser(), ["user" => $targetuser, "canEdit" => true]);
                            }
                            else if ($currentUserRole === $targetUserRole){
                                //user bekijkt/edit zichzelf
                                $this->viewPage($this->CMSUser(), ["user" => $targetuser, "canEdit" => true]);
                            }else if ($currentUserRole===1 && $targetUserRole>=1){
                                //admin bekijkt andere (super)admin, maar kan niet editen
                                $this->viewPage($this->CMSUser(), ["user" => $targetuser, "canEdit" => false]);
                            }else if ($currentUserRole===1 && $targetUserRole===0){
                                //admin bekijkt/edit een user
                                $this->viewPage($this->CMSUser(), ["user" => $targetuser, "canEdit" => true]);
                            }
                        }
                        catch(Exception $e) {
                            die("Unable to get user");
                        }
                    } else {
                        $this->redirectToHome();
                    }
                }
            }
    }
     private function validateCustomerUpdateInput($p)
     {
         if (isset($p["fn"])) {
             if (empty($p["fn"])) {
                 return false;
             }
             if (strlen($p["fn"]) < 2) {
                 return false;
             }
         } else {
             return false;
         }
         if (isset($p["ln"])) {
             if (empty($p["ln"])) {
                 return false;
             }
             if (strlen($p["ln"]) < 2) {
                 return false;
             }
         } else {
             return false;
         }
         if (isset($p["em"])) {
             if (empty($p["em"])) {
                 return false;
             }
             if (strlen($p["em"]) == 0) {
                 return false;
             }
             if (strpos($p["em"], '@') === false) {
                 return false;
             }
             if (strpos($p["em"], '.') === false) {
                 return false;
             }
         } else {
             return false;
         }
         return true;
     }
     private function validateUserUpdateInput($p)
     {
         if (isset($p["fn"])) {
             if (empty($p["fn"])) {
                 return false;
             }
             if (strlen($p["fn"]) < 2) {
                 return false;
             }
         } else {
             return false;
         }
         if (isset($p["ln"])) {
             if (empty($p["ln"])) {
                 return false;
             }
             if (strlen($p["ln"]) < 2) {
                 return false;
             }
         } else {
             return false;
         }
         if (isset($p["em"])) {
             if (empty($p["em"])) {
                 return false;
             }
             if (strlen($p["em"]) == 0) {
                 return false;
             }
             if (strpos($p["em"], '@') === false) {
                 return false;
             }
             if (strpos($p["em"], '.') === false) {
                 return false;
             }
         } else {
             return false;
         }
         if (isset($p["role"])) {
             if (empty($p["role"])) {
                 return false;
             }
             if (!(in_array($p["role"], ["USER", "ADMIN", "SUPERADMIN"]))) {
                 return false;
             }
         } else {
             return false;
         }
         return true;
     }
     private function Rolecheck($currentRole, $desiredRole, $editor) {
         $order = ["USER", "ADMIN", "SUPERADMIN"];
         if (!in_array($currentRole, $order)) {
             die("Bad Input");
         }
         if (!in_array($desiredRole, $order)) {
             die("Bad Input");
         }
         if ($editor == null) {
             //self edit
             $indexCurrent = array_search($currentRole, $order);
             $indexDesired = array_search($desiredRole, $order);
             if ($indexDesired > $indexCurrent) {
                 return $currentRole;
             } else {
                 return $desiredRole;
             }
         } else {
             //(super)admin edits someone else
             $indexEditor = array_search($editor, $order);
             $indexUserDesired = array_search($desiredRole, $order);
             if ($indexUserDesired <= $indexEditor) {
                 return $desiredRole;
             } else {
                 return $currentRole;
             }
         }
     }
     public function deleteUser(){
        if ($this->Authorize() and $_SERVER['REQUEST_METHOD'] === 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
             if ($this->repo->deleteUser($_POST['id'])){
                if ($this->getUser()->id == $_POST['id']){
                    $this->logout();
                }else {
                    $this->viewPage($this->CMSUsers(), ["msg" => "User deleted"]);
                }
            }else{
                $this->viewPage($this->CMSUsers(),["msg"=>"Error deleting user"]);
            }

        }
     }
     public function deleteCustomer(){
         if ($this->Authorize() and $_SERVER['REQUEST_METHOD'] === 'POST'){
             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
             if ($this->repo->deleteCustomer($_POST['id'])){
                 $this->viewPage($this->CMSCustomers(), ["msg" => "User deleted"]);
             }else{
                 $this->viewPage($this->CMSCustomers(),["msg"=>"Error deleting user"]);
             }

         }
     }
     public function updateCustomer() {
         if ($_SERVER['REQUEST_METHOD'] === 'POST' and $this->Authorize()) {
             if (isset($_POST["id"])) {
                 try {
                     $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                     $inputValid = $this->validateCustomerUpdateInput($_POST); //check input integrity
                     if (!$inputValid){
                         $this->redirectToHome();
                     }
                     $emailChanged=false;
                     $user = $this->repo->findCustomer($_POST["id"]);
                     if ($user->getEmail()!=$_POST["em"]){
                         $emailChanged=true;
                     }
                     if ($emailChanged && $this->repo->emailTaken($_POST["em"])){
                         $this->redirectToHome();
                     }
                     $confirmationEmailaddresses = Array();
                     $selfEdit = true;
                     array_push($confirmationEmailaddresses,$user->getEmail());
                     if ($emailChanged){
                         //email change, new email address needs confirmation as well
                         array_push($confirmationEmailaddresses,$_POST["em"]);
                     }
                     $updatedUser = new Customer($_POST["fn"], $_POST["ln"], $_POST["em"], $user->getPassword());
                     $updatedUser->id = $user->id;
                     if( $this->repo->updateCustomer($updatedUser)) {
                         if ($emailChanged) {
                             $this->repo->sendProfileUpdateConfirmationEmails($confirmationEmailaddresses);
                         }
                         $this->redirectToCustomers();
                     }else{
                         $this->redirectToHome();
                     }
                 }
                 catch(Exception $e) {
                     die($e->getMessage());
                 }
             } else {
                 $this->redirectToHome();
             }
         } else {
             $this->redirectToHome();
         }
     }
     public function updateUser() {
         if ($_SERVER['REQUEST_METHOD'] === 'POST' and $this->Authorize()) {
             if (isset($_POST["id"])) {
                 try {
                     $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                     $inputValid = $this->validateUserUpdateInput($_POST); //check input integrity
                     if (!$inputValid){
                       $this->redirectToHome();
                     }
                     $emailChanged=false;
                     $user = $this->repo->findById($_POST["id"]);
                     if ($user->getEmail()!=$_POST["em"]){
                         $emailChanged=true;
                     }
                     if ($emailChanged && $this->repo->emailTaken($_POST["em"])){
                        $this->redirectToHome();
                     }
                     $confirmationEmailaddresses = Array();
                     $selfEdit = true;
                     if (!($_POST["id"] === $_SESSION["CMSid"])) {
                         $selfEdit = false;
                         if (!$this->isAnyAdmin()) {
                             $this->redirectToHome();
                         }
                     }
                     array_push($confirmationEmailaddresses,$user->getEmail());
                     $currentRole = $user->getRole();
                     $newRole = $this->Rolecheck($currentRole, $_POST["role"], ($selfEdit ? null : $_SESSION["CMSrole"]));
                     if ($emailChanged){
                         //email change, new email address needs confirmation as well
                         array_push($confirmationEmailaddresses,$_POST["em"]);
                     }
                     $updatedUser = new User($user->getId(), $_POST["fn"], $_POST["ln"], $_POST["em"], $user->getPassword(), $newRole);
                     $update = $this->repo->update($updatedUser);
                     if ($emailChanged){
                         $this->repo->sendProfileUpdateConfirmationEmails($confirmationEmailaddresses);
                     }
                     $this->redirectToUsers();
                 }
                 catch(Exception $e) {
                     die($e->getMessage());
                 }
             } else {
                 $this->redirectToHome();
             }
         } else {
             $this->redirectToHome();
         }
     }
     public function resetPassword() {
          if ($this->Authorize()) {
             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
             if (isset($_GET["email"])){
                 try{
                     $this->repo->resetPassword($_GET["email"]);
                     $this->repo->resetPasswordCustomer($_GET["email"]);
                 }catch(Exception $e){
                     die("Error sending mail.");
                 }
             }
             echo "If your email is registered with us, we've sent you a new one (it's probably in your spam folder).<br>";
             echo "<a href=".URLROOT."/CMS/Login".">Go to Login</a>";
         }
     }
     public function customers(){
         if ($this->Authorize()) {
             if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                 $users = $this->repo->allCustomers();
                 $this->view($this->CMSCustomers(), ['title' => 'Manage Customers','customers'=> $users]);
             }
         }
     }
     public function customer(){
         if ($this->Authorize()) {
             if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                 if (isset($_GET["id"])) {
                     try {
                         $user = $this->repo->findCustomer($_GET["id"]);
                         $this->viewPage($this->CMSCustomer(),['customer'=>$user]);
                     }
                     catch(Exception $e) {
                         die("Unable to get user");
                     }
                 } else {
                     $this->redirectToHome();
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