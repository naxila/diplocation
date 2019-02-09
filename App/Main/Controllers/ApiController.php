<?php

require_once "App/Main/Models/User.php";
require_once "App/Main/Models/Flat.php";
require_once "App/Main/Models/Dictionary.php";
require_once "App/Main/Helpers/Validator.php";

class ApiController extends Controllers {

	/* User operations */

	public function login() {

		$_POST = json_decode(file_get_contents('php://input'), true);

		if (!isset($_POST) || count($_POST) == 0) return self::jsonResult(false, "Invalid arguments", 403);

		$user = User::login($_POST['login'], $_POST['password']);

		if (!$user) return self::jsonResult(false, "Wrong login or password");
		else return self::jsonResult(true, $user);
	}

	public function singIn() {
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!Validator::singInQueryValidate($_POST)) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);

		if (!User::checkLohin($login)) return self::jsonResult(false, "Такой логин занят.");
		if (!User::checkEmail($email)) return self::jsonResult(false, "Такой email занят.");

		$user = User::create($name, $phone, $email, $password);

		if ($user) return self::jsonResult(true, "На номер выслан код подтверждения.");
		else return self::jsonResult(false, "Ошибка при регистрации");
	}

	public function status() {
		if (!isset($_GET['token'])) return self::jsonResult(false, "Token missed", 403);
		$result = User::status($_GET['token']);
		if (!$result) return self::jsonResult(false, "Invalid token");
		else return self::jsonResult(true, $result);
	}



	/* Token free methods */

	public function cities() {
		if (!isset($_GET['country_id'])) return self::jsonResult(false, "Invalid arguments", 403);
		$cities = Dictionary::cities($_GET['country_id']);
		if (!$cities) return self::jsonResult(false, "Cities not found");
		return self::jsonResult(true, $cities);
	}

	public function buildings() {
		if (!isset($_GET['city_id'])) return self::jsonResult(false, "Invalid arguments", 403);
		$buildings = Dictionary::buildings($_GET['city_id']);
		if (!$buildings) return self::jsonResult(false, "Buildings not found");
		return self::jsonResult(true, $buildings);
	}

	public function countries() {
		$countries = Dictionary::countries();
		if (!$countries) return self::jsonResult(false, "Countries not found");
		return self::jsonResult(true, $countries);
	}



	/* Token required methods */

	public function flats() {
		self::checkAccess();
		if (!Validator::flatQueryValidate($_GET)) return self::jsonResult(false, "Invalid arguments", 403);
		extract($_GET);
		$flats = Flat::get($city_id, $min_price, $max_price, $order_by, $limit, $offset);
	
		if (!flats) return self::jsonResult(false, "Invalid query");
		return self::jsonResult(true, $flats);
	}



	/* Help methods */

	private function checkAccess() {

		if (!isset($_GET['token'])) {
			self::jsonResult(false, "Token missed", 403);
			exit();
		}
		$result = User::status($_GET['token']);
		if (!$result) {
			self::jsonResult(false, "Invalid token");
			exit();
		}
	}

	public function test() {
		$res = preg_match('/\+[0-9]{11, 15}/', "+79640273064");
		var_dump($res);
	}

}