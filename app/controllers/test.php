<?php
class test extends Controller
{
    public function __construct()
    {
        $this->repo = $this->repo('testRepo');
    }
    public function index() {
        $editableObj = $this->repo->getEditable('users','id');
        $this->view('test', ['content'=>$editableObj]);
    }
    public function Process(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if ($this->repo->process($_POST)){
                $goto = explode('haarlemfestival/', $_SERVER['HTTP_REFERER'])[1];
              redirect($goto);
            }else{
                die("Error editing data");
            }
        }
    }
}
?>