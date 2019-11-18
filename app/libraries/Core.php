<?php
    /*  App Core Class
     *  Creates URL & loads core controller
     *  URL format - /controller/method/params
     */

     class Core{
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $parameters = [];

        public function __construct(){
            //print_r($this->getUrl());
            
            $url = $this->getUrl();

            // Look in controllers (paths) for the first value
            if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
                // If its found, set is as controller
                $this->currentController = ucwords($url[0]);                
                // Unset the 0 index
                unset($url[0]);
            }

            // Require the controller
            require_once '../app/controllers/' . $this->currentController . '.php';

            // Instantiate controller class
            $this->currentController = new $this->currentController;

            // Check 2nd part of the url
            if(isset($url[1])){
                // Does this method exist in the controller
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    // Unset the 1 index
                    unset($url[1]);
                }
            }

            // Get parameters for the method
            $this->parameters = $url ? array_values($url) : [];

            // Call a callback with array of parameters
            call_user_func_array([$this->currentController, $this->currentMethod], $this->parameters);
        }

        public function getUrl(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }            
        }
     }