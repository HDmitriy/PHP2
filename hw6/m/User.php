<?php
	include_once 'config/db.php';

	class User {
		
		public $user_id, $user_name, $user_password;
        private $connect;

		public function __construct () {
            $this->connect = $this->connecting();
		}


		public function pass ($name, $password) {
			return strrev(md5($name)) . md5($password);
		}

		public function connecting () {
			return new PDO(DRIVER . ':host='. SERVER . ';dbname=' . DB, USERNAME, PASSWORD);
		}

		public function get ($id) {
			return  $this->connect->query("SELECT * FROM users WHERE id = '" . $id . "'")->fetch();
		}

		public function newReg ($name, $password) {
			$user = $this->connect->query("SELECT * FROM users WHERE name = '" . $name . "'")->fetch();
			if (!$user) {
				if($this->connect->exec("INSERT INTO users VALUES (
                          null, '" . $name . "', ' ', '" .
                    $this->pass($name, $password) . "')")){
                    return "Вы зарегистрировались!";
                }

			} else {
				return "Логин уже занят!";
			}
		}

		public function login ($name, $password) {
			$user = $this->connect->query("SELECT * FROM users WHERE name = '" . $name . "'")->fetch();
			if ($user) {
				if ($user['password'] == $this->pass($user['name'], strip_tags($password))) {
    				$_SESSION['user_id'] = $user['id'];
    				return 'Добро пожаловать, ' . $user['name'] . '!';
				} else {
					return 'Неправильный пароль!';
				}
			} else {
				return 'Такого логина не существует!';
			}
		}

		public function logout () {
			if ($_SESSION["user_id"]) {
				$_SESSION["user_id"]=null;
				session_destroy();
				return true;
			} 
			return false;
			
		}
	}
?>