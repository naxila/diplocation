<?php

require_once "App/Main/System/Database.php";

class Model extends Database {

	public static function Check() {
		return "Models works good.";
	}

	public static function ddlog($var) {
		var_dump($var);
		die();
	}

}