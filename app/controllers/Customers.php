<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
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
            } else{
                if($this->repo->findByEmail($data['email'])){
                    $data['email_error'] = 'Email is already taken';
                }
                elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                        $data['email_error'] = 'This is not a valid email address';
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
            } elseif($data['password'] != $data['confirm_password']){
                    $data['confirm_password_error'] = 'Passwords do not match';
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
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Sanitize inputs                    
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $email = (string)trim($_POST['email']);
            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);
            $url = URLROOT . '/customers/createnewpw?selector=' . $selector . '&validator=' . bin2hex($token);
            $expires = date("U") + 600;           

            $data =[                 
                'email' => $email,
                'email_error' => ''
            ];

            // Validation
            if(empty($data['email'])){
                $data['email_error'] = 'Please enter email';
            } elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_error'] = 'This is not a valid email address';
            }

            // Check is customer/email exists in db            
            if($this->repo->findByEmail($email)){
                // Customer found
            } else{
                // Customer not found
                $data['email_error'] = 'There is no account registered with that email';
            }

            // Process only if there are no errors
            if(empty($data['email_error'])){
                // delete tokens that might exist
                $this->repo->deleteToken($email);
                $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                $this->repo->saveToken($email, $selector, $hashedToken, $expires);

                $mail = new PHPMailer(TRUE);

                $mail->isSMTP();
                $mail->Host = 'mail.smtp2go.com';
                $mail->SMTPAuth = true;
                $mail->Username = '625583@student.inholland.nl';
                $mail->Password = 'APy6jeAZ5MhM';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 2525;

                $mail->setFrom("info@haarlem-festival.nl", "Haarlem Festival"); 
                $mail->addAddress($email, 'Dear customer');   
                $mail->Subject = "Reset your password";
                $mail->Body = 'We received a password reset request. If you did not request to reset your password, you can ignore this email.';
                $mail->Body .= 'Here is your password reset link: ';
                $mail->Body .= $url;

                try {
                    $mail->send();
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                } catch (\Exception $ex) {
                    echo $ex->getMessage();
                }
                flash('reset_sent_succes', 'A reset link has been sent, please check your email');
                redirect('customers/login');

            } else{
                // Load view with error messages
                $this->view('customers/resetpw', $data);
            }
        
        } else{
            // Not a post, so load the view with 'empty' data
            $data =[
                'email' => '',               
                'email_error' => ''
            ];           
            $this->view('customers/resetpw', $data);
        }
    }

    public function createnewpw(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $selector = $_POST['selector'];
            $validator = $_POST['validator'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            $data =[
                'selector' => $selector,
                'validator' => $validator,
                'password' => (string)trim($password),
                'confirm_password' => (string)trim($confirm_password)                
            ];       
            
            if(empty($data['password'])){
                $data['password_error'] = 'Please enter password';
            } elseif(strlen($data['password']) < 6 ){
                $data['password_error'] = 'Password must be at least 6 characters';
            }

            if(empty($data['confirm_password'])){
                $data['confirm_password_error'] = 'Please confirm password';
            } elseif($data['password'] != $data['confirm_password']){
                    $data['confirm_password_error'] = 'Passwords do not match';
            }

            if(empty($data['password_error']) && empty($data['confirm_password_error'])){                
                $currentDate = date("U");
                
                $result = $this->repo->getToken($selector, $currentDate);
                $tokenBin = hex2bin($validator);
                $tokenCheck = password_verify($tokenBin, $result->resetToken);

                if ($tokenCheck === false) {
                    echo 'You need to re-submit your reset request.';
                } elseif($tokenCheck === true){
                    $tokenEmail = $result->resetEmail;
                    $newPasswordHash = password_hash($password, PASSWORD_DEFAULT);
                    if($this->repo->updatePassword($tokenEmail, $newPasswordHash)){
                        $this->repo->deleteToken($tokenEmail);
                        flash('pwreset_succes', 'Your password has been reset!');
                        redirect('customers/login');
                    }
                }
            } else{
                // Load view with error messages
                $this->view('customers/createpw', $data);
            }

        } else {    
            // Not a post, so load the view
            $selector = $_GET['selector'];
            $validator = $_GET['validator'];

            if(empty($selector) || empty($validator)){
                echo 'Could not validate your request';
            } else{
                if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
                    $data =[
                        'selector' => $selector,
                        'validator' => $validator,
                        'password' => '',
                        'confirm_password' => '',
                        'password_error' => '',
                        'confirm_password_error' => '',
                        'match_password_error' => ''
                    ];       
                    $this->view('customers/createpw', $data);
                }
            }
        }

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