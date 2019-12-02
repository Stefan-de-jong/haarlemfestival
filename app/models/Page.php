<?php
    class Page{
        public $id;
        public $title;
        public $html;

        public function __construct($id, $title,$html){
            $this->id = $id;
            $this->title = $title;
            $this->html = $html;
        }

        
    }

?>