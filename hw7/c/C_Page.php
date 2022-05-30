<?php

include_once('m/model.php');
include_once 'm/Product.php';
include_once 'm/Basket.php';

class C_Page extends C_Base
{
	
	
	public function action_index(){
		$this->title .= '::Чтение';
		$text = text_get();
		$this->content = $this->Template('v/v_index.php', array('text' => $text));	
	}
	
	public function action_edit(){
		$this->title .= '::Редактирование';
		
		if($this->isPost())
		{
			text_set($_POST['text']);
			header('location: index.php');
			exit();
		}
		
		$text = text_get();
		$this->content = $this->Template('v/v_edit.php', array('text' => $text));		
	}
	public function action_catalog() {
			
		$product_object = new Product();
		$catalog = $product_object->getAllProducts();

		$this->title .= ' | Каталог';
		$this->content = $this->Template('v/v_catalog.php', array('catalog' => $catalog));
	}

	public function action_product($id) {

		$product_object = new Product();
		$product = $product_object->getProduct($id);
		if ($_SESSION['user_id']) {
			$user_id = $_SESSION['user_id'];
		} else {
			$user_id = false;
		}

		$this->title .= ' | ' . $product['title'];
		$this->content = $this->Template('v/v_product.php', array('product' => $product, 'user_id' => $user_id));

		if($this->isPost()) {
			$new_basket = new Basket();
			$result = $new_basket->addProduct($product['id'], $user_id, $_POST['count']);
			$this->content = $this->Template('v/v_product.php', array('product' => $product, 'user_id' => $user_id, 'text' => $result));
		}

	}

	public function action_basket() {
			
		if ($_SESSION['user_id']) {
			$user_id = $_SESSION['user_id'];
		} else {
			$user_id = false;
		}

		$basket_object = new Basket();
		$basket = $basket_object->getBasket($user_id);

		$this->title .= ' | Корзина заказов';
		$this->content = $this->Template('v/v_basket.php', array('products' => $basket));

		if($this->isPost()) {
			$orderId = $_POST['order'];
			$basket_object->removeProduct($orderId);
			$this->content = $this->Template('v/v_basket.php', array('products' => $basket));
		}
	}
}
