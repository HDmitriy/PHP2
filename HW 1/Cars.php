<?php
include_once "Product.php";

class Cars extends Product{
   public function __construct($name, $price, $description, $color)
   {
        parent::__construct($name, $price, $description);
        $this->color = $color;
   }

    public function paint(){
    }
}









