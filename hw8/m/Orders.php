<?php
	include_once 'SQL.php';

	class Orders extends SQL {

		public $order_id, $product_id, $user_id, $count, $status;

		public function getOrder($user_id) {

			return parent::SelectJoin('basket', 'products', 'product_id', 'id', 'user_id', $user_id);
		}
        public function startOrder($status) {
			$object = [
				'status' => $status=1,
			];
			
			parent::Update('basket', $object, $status);
            return 'Заказ оформлен!';
			
		}
	}
?>