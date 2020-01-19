<?php 
 class Customers extends Controller{
    public function __construct(){
        $this->repo = $this->repo('CustomerRepository');
        $this->model = $this->model('Customer');
    }

    public function register(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            // Sanitize customer inputs         
            $sanitizeFilters = array(
                'firstname' => FILTER_SANITIZE_STRING,
                'lastname' => FILTER_SANITIZE_STRING,
                'email' => FILTER_SANITIZE_EMAIL,
                'password' => FILTER_SANITIZE_STRING,
                'confirm_password' => FILTER_SANITIZE_STRING
            );
            $_POST = filter_input_array(INPUT_POST, $sanitizeFilters);

            // Init data
            $data =[
                'firstname' => (string)trim($_POST['firstname']),
                'lastname' => (string)trim($_POST['lastname']),
                'email' => (string)trim($_POST['email']),
                'password' => (string)trim($_POST['password']),
                'confirm_password' => (string)trim($_POST['confirm_password']),
                'firstname_error' => '',
                'lastname_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Validation
            if(empty($data['email'])){
                $data['email_error'] = 'Please enter email';
            } else{if($this->repo->findByEmail($data['email'])){
                    $data['email_error'] = 'Email is already taken';
                }
                else{if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                        $data['email_error'] = 'This is not a valid email address';
                    }
                }
            }

            if(empty($data['firstname'])){
                $data['firstname_error'] = 'Please enter first name';
            }

            if(empty($data['lastname'])){
                $data['lastname_error'] = 'Please enter last name';
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
            if(empty($data['email_error']) && empty($data['firstname_error']) && empty($data['lastname_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])){                
                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register customer
                $customer = new Customer($data['firstname'],$data['lastname'],$data['email'],$data['password']);
                if($this->repo->save($customer)){
                    flash('register_succes', 'You are registered and can log in');
                    redirect('customers/login');
                } else {
                    die('Something went wrong');
                }
            } else{
                // Load view with error messages
                $this->view('customers/register', $data);
            }

        } else{
            // Init data
            $data =[
                'firstname' => '',
                'lastname' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'firstname_error' => '',
                'lastname_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Load view
            $this->view('customers/register', $data);
        }
    }

    public function login(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Sanitize inputs
            $sanitizeFilters = array(                
                'email' => FILTER_SANITIZE_EMAIL,
                'password' => FILTER_SANITIZE_STRING
            );
            $_POST = filter_input_array(INPUT_POST, $sanitizeFilters);

            $data =[                 
                'email' => (string)trim($_POST['email']),
                'password' => (string)trim($_POST['password']),
                'email_error' => '',
                'password_error' => ''
            ];

            // Validation
            if(empty($data['email'])){
                $data['email_error'] = 'Please enter email';
            }
            if(empty($data['password'])){
                $data['password_error'] = 'Please enter password';
            }

            // Check is customer/email exists in db            
            if($this->repo->findByEmail($data['email'])){
                // Customer found
            } else{
                // Customer not found
                $data['email_error'] = 'There is no account registered with that email';
            }

            // Process only if there are no errors
            if(empty($data['email_error']) && empty($data['password_error'])){
                // Check and set logged in customer
                $loggedInCustomer = $this->repo->login($data['email'], $data['password']);

                if($loggedInCustomer){
                    // Create session
                    $this->createCustomerSession($loggedInCustomer);
                } else {
                    $data['password_error'] = 'Password incorrect';
                    $this->view('customers/login', $data);
                }

            } else{
                // Load view with error messages
                $this->view('customers/login', $data);
            }


        } else{
            // Not a post, so load the view with 'empty' data
            $data =[
                'email' => '',
                'password' => '',                
                'email_error' => '',
                'password_error' => ''
            ];           
            $this->view('customers/login', $data);
        }
    }

    public function forgotpassword(){
        // ToDo: set up forgot password
        // check for post

        // POST
            // sanitize input
            // check for errors

            // NO ERRORS
                // process and send email with passrecovlink

            // ERRORS
                // load forgotpass form with error message

        // NOT POST
            // load forgotpass form
    }

    public function createCustomerSession($customer){
        $_SESSION['customer_id'] = $customer->id;
        $_SESSION['customer_firstname'] = $customer->first_name;
        $_SESSION['customer_lastname'] = $customer->last_name;
        $_SESSION['customer_email'] = $customer->email;
        redirect('pages/index');
    }

    public function logout(){
        unset($_SESSION['customer_id']);
        unset($_SESSION['customer_firstname']);
        unset($_SESSION['customer_lastname']);
        unset($_SESSION['customer_email']);
        session_destroy();
        redirect('customers/login');
    }    
 }
?>