<?php 
 class Users extends Controller{
    public function __construct(){
        $this->userModel = $this->model('UserRepository');
    }

    public function register(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            // process form

            // Sanitize user inputs
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data =[
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Validation
            if(empty($data['email'])){
                $data['email_error'] = 'Please enter email';
            } else{
                // Check if email exists in db
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_error'] = 'Email is already taken';
                }
            }

            if(empty($data['name'])){
                $data['name_error'] = 'Please enter name';
            }

            if(empty($data['password'])){
                $data['password_error'] = 'Please enter password';
            } elseif(strlen($data['password']) < 6 ){
                $data['password_error'] = 'Password must be at least 6 characters';
            }

            if(empty($data['confirm_password'])){
                $data['confirm_password_error'] = 'Please confirm password';
            } else {
                if($data['password'] != $data['confirm_password']){
                    $data['confirm_password_error'] = 'Passwords do not match';
                }
            }

            // Process only if there are no errors
            if(empty($data['email_error']) && empty($data['name_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])){
                // no errors

                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register user
                $user = new User($data['name'],$data['email'],$data['password']);
                if($this->userModel->save($user)){
                    flash('register_succes', 'You are registered and can log in');
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }

            } else{
                // Load view with error messages
                $this->view('users/register', $data);
            }


        } else{
            // Init data
            $data =[
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Load view
            $this->view('users/register', $data);
        }
    }

    public function login(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // process form
            // Sanitize user inputs
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data =[                 
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'password_error' => '',

            ];

            // Validation
            if(empty($data['email'])){
                $data['email_error'] = 'Please enter email';
            }

            if(empty($data['password'])){
                $data['password_error'] = 'Please enter password';
            }

            // Check is user/email exists in db
            if($this->userModel->findUserByEmail($data['email'])){
                // User found
            } else{
                // User not found
                $data['email_error'] = 'User not found';
            }

            // Process only if there are no errors
            if(empty($data['email_error']) && empty($data['password_error'])){
                // No errors
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if($loggedInUser){
                    // Create session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_error'] = 'Password incorrect';
                    $this->view('users/login', $data);
                }

            } else{
                // Load view with error messages
                $this->view('users/login', $data);
            }


        } else{
            // Init data
            $data =[
                'email' => '',
                'password' => '',                
                'email_error' => '',
                'password_error' => ''
            ];

            // Load view
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->userId;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->userName;
        $_SESSION['user_role'] = $user->userRole;
        redirect('posts');
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        session_destroy();
        redirect('users/login');
    }

    public function profile(){
        // Get logged in user
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        $data = [
            'user' => $user
        ];
        $this->view('users/profile', $data);
    }

    public function management(){
        // Get users
        $users = $this->userModel->getUsers();

        $data = [
            'users' => $users
        ];

        $this->view('users/management', $data);
    }


    public function edit($id){      
        // Check for POST
        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            // process form

            // Sanitize user inputs
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            switch($_POST['role']){
                case 'user':
                $userRole = '1';
                break;
                case 'admin':
                $userRole = '2';
                break;
                case 'superadmin':
                $userRole = '3';
                break;
                default:
                echo 'Invalid selection'; 
            }

            // Init data
            $data =[
                'user_id' => $id,
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'role' => $userRole,
                'bio' => trim($_POST['bio']),
                'name_error' => '',
                'email_error' => ''
            ];

            // Validation
            if(empty($data['email'])){
                $data['email_error'] = 'Please enter email';
            } else{
                // Check if email has changed
                // get user to edit
                $user = $this->userModel->getUserById($id); 
                if($user->email != $data['email']){
                    // Email has changed, so check if new email exists in db
                    if($this->userModel->findUserByEmail($data['email'])){
                        $data['email_error'] = 'Email is already taken';
                    }
                }
            }

            if(empty($data['name'])){
                $data['name_error'] = 'Please enter name';
            }            

            // Process only if there are no errors
            if(empty($data['email_error']) && empty($data['name_error'])){
                // no errors            

                // Edit user
                if($this->userModel->edit($data)){
                    flash('edit_succes', 'Saved changes');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }

            } else{
                // Load view with error messages
                $this->view('users/edit', $data);
            }
        } else{ 
            // Get the user to edit
            $user = $this->userModel->getUserById($id);
                        
            // Check if profile belongs to logged in user or logged in user is admin / superadmin
            if($id != $_SESSION['user_id']){
                
                if( ($_SESSION['user_role'] === 'admin') || ($_SESSION['user_role'] === 'superadmin') ){
                    // admin or superadmin may edit other users
                } else{
                    redirect('posts');
                }
            } 

            $data = [
                'id' => $id,
                'name' => $user->userName,
                'email' => $user->email,
                'role' => $user->userRole,
                'bio' => $user->bio
            ];

            $this->view('users/edit', $data);
        }            
    }
    
    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Get the user to delete from model
            $post = $this->userModel->getUserById($id);
            
            // Check if logged in user is superadmin
            if($_SESSION['user_role'] != 'superadmin'){
                redirect('posts');
            }

            if($this->userModel->deleteUser($id)){
                flash('user_message', 'User removed');
                redirect('users/management');
            }
            else {
                die('Something went wrong');
            }
        } else {
            redirect('users/management');
        }
    }



 }
?>