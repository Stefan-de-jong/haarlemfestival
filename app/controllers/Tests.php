<?php
    class Tests extends Controller{
        public function __construct(){

            $this->testModel = $this->model('TestRepository');            
        }

        public function index(){
            $tests = $this->testModel->findAll();

            $data = [
                'tests' => $tests
            ];

            $this->view('tests/index', $data);
        }

        

    }

?>