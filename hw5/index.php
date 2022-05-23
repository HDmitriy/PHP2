<?php

spl_autoload_register(function($name) {
	include_once("c/$name.php");
});

$action = 'action_';
$action .= ($_GET['act']) ? $_GET['act'] : 'index';

if ($_GET['c']) {
	if ($_GET['c'] == 'page') {
		$controller = new C_Page();
	} else if ($_GET['c'] == 'user') {
		$controller = new C_User();
	}
} else {
	$controller = new C_Page();
}

$controller->Request($action);