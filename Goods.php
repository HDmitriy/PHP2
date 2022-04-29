<?php

abstract class Goods { 
    
    const PROFIT = 5; 
    abstract public function finalCost(); 
    abstract public function profitCost();  

} 
 



class DigitalGood extends Goods {
    
    const PRICE = 1000;	
    private $quantity;

    public function __construct($quantity)
    {
        self::setQuantity($quantity);
    }
    
    public function setQuantity($quantity=0)
    {
        $this->quantity = $quantity;
    }
    
    public function finalCost()
    {
        return self::PRICE * $this->quantity;
    }

    public function profitCost()
    {
        return  $this->finalCost() / 100 * parent::PROFIT;
    }

}

class CountGood extends Goods{
    
    private $price;
    private $quantity;
    
    public function __construct($price, $quantity)
    {
        self::setPrice($price);
        self::setQuantity($quantity);
    }
    
    public function setPrice($price=0)
    {
        $this->price = $price;
    }
    
    public function setQuantity($quantity=0)
    {
        $this->quantity = $quantity;
    }
    
    public function finalCost()
    {
        return $this->price * $this->quantity;
    }
    
    public function profitCost()
    {
        return $this->price * $this->quantity / 100 * parent::PROFIT;
    }

}



class WeightGood extends Goods {
    
    private $price;
    private $weight;
    
    public function __construct($price, $weight)
    {
        self::setPrice($price);
        self::setWeight($weight);
    }
    
    public function setPrice($price=0)
    {
        $this->price = $price;
    }
    
    public function setWeight($weight=0)
    {
        $this->weight = $weight;
    }
    
    public function finalCost()
    {
        return $this->price * $this->weight;
    }
    
    public function profitCost()
    {
        return $this->price * $this->weight / 100 * parent::PROFIT;
    }
}


$obj1 = new DigitalGood();
$obj2 = new CountGood();
$obj3 = new WeightGood();

?>