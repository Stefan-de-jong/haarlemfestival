<?php
    class Restaurant
    {
        public $id;
        public $name;
        public $info_page;
        public $kitchen1;
        public $kitchen2;
        public $stars;
        public $price;
        public $address;

        public function __construct($id, $name, $info_page, $kitchen1, $kitchen2, $stars, $price, $address)
        {
            $this->id = $id;
            $this->name = $name;
            $this->info_page = $info_page;
            $this->kitchen1 = $kitchen1;
            $this->kitchen2 = $kitchen2;
            $this->stars = $stars;
            $this->price = $price;
            $this->address = $address;
        }
    }
?>