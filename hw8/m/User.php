<?php
	include_once 'SQL.php';

	class User extends SQL {
		
		public $user_id, $user_name, $user_password;

		public function get ($id) {
			
			return parent::Select('users', 'id', $id);
		}

		public function newReg ($name, $password) {
			
			$object = [
				'name' => strip_tags($name),
				'password' => parent::Password(strip_tags($name), strip_tags($password))
			];
			$user = parent::Select('users', 'name', strip_tags($name));

			if (!$user) {
				parent::Insert('users', $object);
				return 'Вы успешно зарегистрировались!';
			} else {
				return 'Это имя занято!';
			}
		}

		public function login ($name, $password) {
			
			$user = parent::Select('users', 'name', strip_tags($name));

			if ($user) {
				if ($user['password'] == parent::Password($user['name'], strip_tags($password))) {
    				$_SESSION['user_id'] = $user['id'];
    				return 'Добро пожаловать в систему, ' . $user['name'] . '!';
				} else {
					return 'Пароль не верный!';
				}
			} else {
				return 'Пользователя с таким именем нет!';
			}
		}

		public function logout () {
			
			if ($_SESSION["user_id"]) {
				unset($_SESSION["user_id"]);
				session_destroy();
				return true;
			} else {
				return false;
			}
		}
	}
?>