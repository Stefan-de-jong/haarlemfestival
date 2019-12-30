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

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @return mixed
         */
        public function getTitle()
        {
            return $this->title;
        }

        /**
         * @return mixed
         */
        public function getHtml()
        {
            return $this->html;
        }

        
    }

?>