<?php
    /*
     * Base Controller
     * Loads the models and views
     * Other controllers will extend this
     */ 
    class Controller {
        // Load model
        public function model($model){
            // Require the model file
            require_once '../app/models/' . $model . '.php';
        }

        public function repo($repo){
            // Require the repo file
            require_once '../app/repos/' . $repo . '.php';

            // Instantiate and return the model
            return new $repo();
        }


        // Load view
        public function view($view, $data=[]){
            // See if there is a view file, require it
            if(file_exists('../app/views/' . $view . '.php')){
                require_once '../app/views/' . $view . '.php';
            } else{
                die('View does not exist');
            }
        }


    }



?>