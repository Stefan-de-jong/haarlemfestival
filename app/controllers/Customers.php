<?php 
 class Customers extends Controller{
    public function __construct(){
        $this->repo = $this->repo('CustomerRepository');
        $this->model = $this->model('Customer');
    }

    public function register(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            // process form

            // Sanitize customer inputs
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data =[
                'firstname' => trim($_POST['firstname']),
                'lastname' => trim($_POST['lastname']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'firstname_error' => '',
                'lastname_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Validation
            if(empty($data['email'])){
                $data['email_error'] = 'Please enter email';
            } else{
                // Check if email exists in db
                if($this->repo->findByEmail($data['email'])){
                    $data['email_error'] = 'Email is already taken';
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
                // no errors

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
            // process form
            // Sanitize customer inputs
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

            // Check is customer/email exists in db
            if($this->customerModel->findCustomerByEmail($data['email'])){
                // Customer found
            } else{
                // Customer not found
                $data['email_error'] = 'Customer not found';
            }

            // Process only if there are no errors
            if(empty($data['email_error']) && empty($data['password_error'])){
                // No errors
                // Check and set logged in customer
                $loggedInCustomer = $this->customerModel->login($data['email'], $data['password']);

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
            // Init data
            $data =[
                'email' => '',
                'password' => '',                
                'email_error' => '',
                'password_error' => ''
            ];

            // Load view
            $this->view('customers/login', $data);
        }
    }

    public function createCustomerSession($customer){
        $_SESSION['customer_id'] = $customer->customerId;
        $_SESSION['customer_email'] = $customer->email;
        $_SESSION['customer_name'] = $customer->customerName;
        $_SESSION['customer_role'] = $customer->customerRole;
        redirect('pages/index');
    }

    public function logout(){
        unset($_SESSION['customer_id']);
        unset($_SESSION['customer_email']);
        unset($_SESSION['customer_name']);
        unset($_SESSION['customer_role']);
        session_destroy();
        redirect('customers/login');
    }    
 }
?>