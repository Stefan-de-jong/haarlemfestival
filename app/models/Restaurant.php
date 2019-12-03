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
        public $rest_img;

        public function __construct($id, $name, $info_page, $kitchen1, $kitchen2, $stars, $price, $address, $rest_img)
        {
            $this->id = $id;
            $this->name = $name;
            $this->info_page = $info_page;
            $this->kitchen1 = $kitchen1;
            $this->kitchen2 = $kitchen2;
            $this->stars = $stars;
            $this->price = $price;
            $this->address = $address;
            $this->rest_img = $rest_img;
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
        public function getName()
        {
            return $this->name;
        }

        /**
         * @return mixed
         */
        public function getInfoPage()
        {
            return $this->info_page;
        }

        /**
         * @return mixed
         */
        public function getKitchen1()
        {
            return $this->kitchen1;
        }

        /**
         * @return mixed
         */
        public function getKitchen2()
        {
            return $this->kitchen2;
        }

        /**
         * @return mixed
         */
        public function getStars()
        {
            return $this->stars;
        }

        /**
         * @return mixed
         */
        public function getPrice()
        {
            return $this->price;
        }

        /**
         * @return mixed
         */
        public function getAddress()
        {
            return $this->address;
        }

        public function getRestImg()
        {
            return $this->rest_img;
        }

    }
?>