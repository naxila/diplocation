<?php

require_once "App/Main/Models/User.php";
require_once "App/Main/Models/Dictionary.php";
require_once "App/Main/Helpers/Validator.php";
require_once "App/Main/Models/Map.php";

class ApiController extends Controllers {

	/* User operations */

	public function login() {

		$_POST = json_decode(file_get_contents('php://input'), true);

		if (!isset($_POST) || count($_POST) == 0) return self::jsonResult(false, "Invalid arguments", 403);

		$user = User::login($_POST['login'], $_POST['password']);

		if (!$user) return self::jsonResult(false, "Неправильный логин или пароль");
		else return self::jsonResult(true, $user);
	}

	public function singIn() {
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!Validator::singInQueryValidate($_POST)) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);

		if (!User::checkLohin($login)) return self::jsonResult(false, "Такой логин занят.");
		if (!User::checkEmail($email)) return self::jsonResult(false, "Такой email занят.");

		$user = User::create($name, $phone, $email, $password);

		if ($user) return self::jsonResult(true, "Пользователь зарегистрирован успешно.");
		else return self::jsonResult(false, "Ошибка при регистрации");
	}

	public function status() {
		if (!isset($_GET['token'])) return self::jsonResult(false, "Token missed", 403);
		$result = User::status($_GET['token']);
		if (!$result) return self::jsonResult(false, "Invalid token");
		else return self::jsonResult(true, $result);
	}



	/* Token free methods */

	public function map() {
		if (!isset($_GET['building_id'])) return self::jsonResult(false, "Invalid arguments", 403);
		$map = Dictionary::map($_GET['building_id']);
		if (!$map) return self::jsonResult(false, "Map not found");
		return self::jsonResult(true, $map);
	}

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

	//Points
	public function addPoint() {
		self::checkAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!Validator::addPointQueryValidate($_POST)) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);

		$map = Map::addPoint($device_id, $title, $building_id);
		if (!$map)  return self::jsonResult(false, "Invalid query");
		return self::jsonResult(true, "Point added!");
	}

	public function updatePoint() {
		self::checkAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!Validator::updatePointQueryValidate($_POST)) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);

		$map = Map::updatePoint($id, $device_id, $title, $building_id);
		if (!$map)  return self::jsonResult(false, "Invalid query");
		return self::jsonResult(true, "Point updated!");
	}

	public function deletePoint() {
		self::checkAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_POST["id"])) return self::jsonResult(false, "Invalid arguments", 403);

		$map = Map::deletePoint($_POST["id"]);
		if (!$map)  return self::jsonResult(false, "Invalid query");
		return self::jsonResult(true, "Point deleted!");
	}


	//Vectors
	public function addVector() {
		self::checkAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!Validator::addVectorQueryValidate($_POST)) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);

		$map = Map::addVector($start_point, $end_point, $distance, $direction);
		if (!$map)  return self::jsonResult(false, "Invalid query");
		return self::jsonResult(true, "Vector added!");
	}

	public function updateVector() {
		self::checkAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!Validator::updateVectorQueryValidate($_POST)) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);

		$map = Map::updateVector($id, $start_point, $end_point, $distance, $direction);
		if (!$map)  return self::jsonResult(false, "Invalid query");
		return self::jsonResult(true, "Vector updated!");
	}

	public function deleteVector() {
		self::checkAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_POST["id"])) return self::jsonResult(false, "Invalid arguments", 403);

		$map = Map::deleteVector($_POST["id"]);
		if (!$map)  return self::jsonResult(false, "Invalid query");
		return self::jsonResult(true, "Vector deleted!");
	}


	//Aliases
	public function addAlias() {
		self::checkAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_POST["point_id"]) || !isset($_POST["title"])) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);

		$map = Map::addAlias($point_id, $title);
		if (!$map)  return self::jsonResult(false, "Invalid query");
		return self::jsonResult(true, "Alias added!");
	}

	public function updateAlias() {
		self::checkAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_POST["id"]) || !isset($_POST["title"])) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);

		$map = Map::updateAlias($id, $title);
		if (!$map)  return self::jsonResult(false, "Invalid query");
		return self::jsonResult(true, "Alias updated!");
	}

	public function deleteAlias() {
		self::checkAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_POST["id"])) return self::jsonResult(false, "Invalid arguments", 403);

		$map = Map::deleteAlias($_POST["id"]);
		if (!$map)  return self::jsonResult(false, "Invalid query");
		return self::jsonResult(true, "Alias deleted!");
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

	private function checkSuperAccess() {
		if (!isset($_GET['token'])) {
			self::jsonResult(false, "Token missed", 403);
			exit();
		}
		$result = User::superStatus($_GET['token']);
		if (!$result) {
			self::jsonResult(false, "Access denied!");
			exit();
		}
	}

	public function test() {
		$res = preg_match('/\+[0-9]{11, 15}/', "+79640273064");
		var_dump($res);
	}

}