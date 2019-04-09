<?php

require_once "App/Main/Models/User.php";
require_once "App/Main/Models/Dictionary.php";
require_once "App/Main/Helpers/Validator.php";
require_once "App/Main/Models/Map.php";
require_once "App/Main/Models/Buildings.php";
require_once "App/Main/Models/Countries.php";
require_once "App/Main/Models/Cities.php";

class ApiController extends Controllers {

	/* User operations */

	public function login() {

		$_POST = json_decode(file_get_contents('php://input'), true);

		if (!isset($_POST) || count($_POST) == 0) return self::jsonResult(false, "Invalid arguments", 403);

		$user = User::loginWithHash($_POST['login'], $_POST['password']);

		if (!$user) return self::jsonResult(false, "Неправильный логин или пароль");
		else return self::jsonResult(true, $user);
	}

	// public function logout() {

	// 	if (!isset($_GET["token"])) return self::jsonResult(false, "Invalid arguments", 403);

	// 	$user = User::logout($_GET["token"]);

	// 	else return self::jsonResult(true, "Logout successfully");
	// }

	public function loginWeb() {

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

	public function getCountry() {
		if (!isset($_GET['id'])) return self::jsonResult(false, "Invalid arguments.");
		$res = Dictionary::getCountry($_GET["id"]);
		if (!$res) return self::jsonResult(true, "No results.");
		return self::jsonResult(true, $res);
	}

	public function getCity() {
		if (!isset($_GET['id'])) return self::jsonResult(false, "Invalid arguments.");
		$res = Dictionary::getCity($_GET["id"]);
		if (!$res) return self::jsonResult(true, "No results.");
		return self::jsonResult(true, $res);
	}

	public function getBuilding() {
		if (!isset($_GET['id'])) return self::jsonResult(false, "Invalid arguments.");
		$res = Dictionary::getBuilding($_GET["id"]);
		if (!$res) return self::jsonResult(true, "No results.");
		return self::jsonResult(true, $res);
	}

	public function getPoint() {
		if (!isset($_GET['id'])) return self::jsonResult(false, "Invalid arguments.");
		$res = Dictionary::getPoint($_GET["id"]);
		if (!$res) return self::jsonResult(true, "No results.");
		return self::jsonResult(true, $res);
	}

	public function getVector() {
		if (!isset($_GET['id'])) return self::jsonResult(false, "Invalid arguments.");
		$res = Dictionary::getVector($_GET["id"]);
		if (!$res) return self::jsonResult(true, "No results.");
		return self::jsonResult(true, $res);
	}

	public function getAlias() {
		if (!isset($_GET['id'])) return self::jsonResult(false, "Invalid arguments.");
		$res = Dictionary::getAlias($_GET["id"]);
		if (!$res) return self::jsonResult(true, "No results.");
		return self::jsonResult(true, $res);
	}


	/* Token required methods */

	public function myBuildings() {
		self::checkAccess();
		$token = $_GET['token'];

		$buildings = User::getCurrentAdminBuildings($token);

		if ($buildings) {
			return self::jsonResult(true, $buildings);
		} else {
			return self::jsonResult(true, "Здания не найдены.");
		}

	}



	//Points
	public function addPoint() {
		self::checkAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!Validator::addPointQueryValidate($_POST)) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);

		self::checkBuildingAccess($building_id);

		$map = Map::addPoint($device_id, $title, $building_id, $_GET["token"]);
		if (!$map)  return self::jsonResult(false, "Invalid query");
		return self::jsonResult(true, "Point added!");
	}

	public function updatePoint() {
		self::checkAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!Validator::updatePointQueryValidate($_POST)) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);
		self::checkPointAccess($id);

		$map = Map::updatePoint($id, $device_id, $title, $building_id, $_GET["token"]);
		if (!$map)  return self::jsonResult(false, "Invalid query");
		return self::jsonResult(true, "Point updated!");
	}

	public function deletePoint() {
		self::checkAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_POST["id"])) return self::jsonResult(false, "Invalid arguments", 403);
		self::checkPointAccess($_POST["id"]);
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
		self::checkPointAccess($start_point);
		self::checkPointAccess($end_point);

		$map = Map::addVector($start_point, $end_point, $distance, $direction, $_GET["token"]);
		if (!$map)  return self::jsonResult(false, "Invalid query");
		return self::jsonResult(true, "Vector added!");
	}

	public function updateVector() {
		self::checkAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!Validator::updateVectorQueryValidate($_POST)) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);
		self::checkPointAccess($start_point);
		self::checkPointAccess($end_point);

		$map = Map::updateVector($id, $start_point, $end_point, $distance, $direction, $_GET["token"]);
		if (!$map)  return self::jsonResult(false, "Invalid query");
		return self::jsonResult(true, "Vector updated!");
	}

	public function deleteVector() {
		self::checkAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_POST["id"])) return self::jsonResult(false, "Invalid arguments", 403);

		self::checkVectorAccess($_POST["id"]);

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
		self::checkPointAccess($point_id);

		$map = Map::addAlias($point_id, $title);
		if (!$map)  return self::jsonResult(false, "Invalid query");
		return self::jsonResult(true, "Alias added!");
	}

	public function updateAlias() {
		self::checkAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_POST["id"]) || !isset($_POST["title"])) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);
		self::checkAliasAccess($id);

		$map = Map::updateAlias($id, $title);
		if (!$map)  return self::jsonResult(false, "Invalid query");
		return self::jsonResult(true, "Alias updated!");
	}

	public function deleteAlias() {
		self::checkAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_POST["id"])) return self::jsonResult(false, "Invalid arguments", 403);
		self::checkAliasAccess($$_POST["id"]);

		$map = Map::deleteAlias($_POST["id"]);
		if (!$map)  return self::jsonResult(false, "Invalid query");
		return self::jsonResult(true, "Alias deleted!");
	}




	/* SUPERUSER methods */

	public function updateUser() {
		self::checkSuperAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_GET["id"])) return self::jsonResult(false, "Invalid arguments", 403);

		$_POST["id"] = $_GET["id"];
		$res = User::updateUser($_POST);

		if (!$res) return self::jsonResult(false, "Error");
		return self::jsonResult(true, "Updated.");
	}

	public function createUser() {
		self::checkSuperAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		
		$res = User::create($_POST);

		if (!$res) return self::jsonResult(false, "Error");
		return self::jsonResult(true, "Created.");
	}

	public function deleteUser() {
		self::checkSuperAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_GET["id"])) return self::jsonResult(false, "Invalid arguments", 403);

		$res = User::deleteUser($_GET["id"]);

		if (!$res) return self::jsonResult(false, "Error");
		return self::jsonResult(true, "Deleted.");
	}

	public function getUsers() {
		self::checkSuperAccess();
		$result = User::getUsers();
		return self::jsonResult(true, $result);
	}

	public function getUser() {
		self::checkSuperAccess();
		if (!isset($_GET["id"])) return self::jsonResult(false, "Invalid arguments", 403);

		$result = User::getUser($_GET["id"]);
		return self::jsonResult(true, $result);
	}

	public function addBuilding() {
		self::checkSuperAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_POST["title"]) || !isset($_POST["city_id"]) || !isset($_POST["address"])) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);
		$res = Buildings::addB($title, $city_id, $address);

		if (!$res) return self::jsonResult(false, "Error");
		return self::jsonResult(true, "Added.");

	}

	public function updateBuilding() {
		self::checkSuperAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_POST["id"]) || !isset($_POST["title"]) || !isset($_POST["city_id"]) || !isset($_POST["address"])) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);
		$res = Buildings::updateB($id, $title, $city_id, $address);

		if (!$res) return self::jsonResult(false, "Error");
		return self::jsonResult(true, "Updated.");
	}

	public function deleteBuilding() {
		self::checkSuperAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_POST["id"])) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);
		$res = Buildings::deleteB($id);

		if (!$res) return self::jsonResult(false, "Error");
		return self::jsonResult(true, "Deleted.");
	}



	//Countries

	public function addCountry() {
		self::checkSuperAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_POST["title"])) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);
		$res = Countries::addC($title);

		if (!$res) return self::jsonResult(false, "Error");
		return self::jsonResult(true, "Added.");

	}

	public function updateCountry() {
		self::checkSuperAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_POST["id"]) || !isset($_POST["title"])) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);
		$res = Countries::updateC($id, $title);

		if (!$res) return self::jsonResult(false, "Error");
		return self::jsonResult(true, "Updated.");
	}

	public function deleteCountry() {
		self::checkSuperAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_POST["id"])) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);
		$res = Countries::deleteC($id);

		if (!$res) return self::jsonResult(false, "Error");
		return self::jsonResult(true, "Deleted.");
	}



	//Cities

	public function addCity() {
		self::checkSuperAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_POST["title"]) || !isset($_POST["country_id"])) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);
		$res = Cities::addC($title, $country_id);

		if (!$res) return self::jsonResult(false, "Error");
		return self::jsonResult(true, "Added.");

	}

	public function updateCity() {
		self::checkSuperAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_POST["id"]) || !isset($_POST["title"]) || !isset($_POST["country_id"])) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);
		$res = Cities::updateC($id, $title, $country_id);

		if (!$res) return self::jsonResult(false, "Error");
		return self::jsonResult(true, "Updated.");
	}

	public function deleteCity() {
		self::checkSuperAccess();
		$_POST = json_decode(file_get_contents('php://input'), true);
		if (!isset($_POST["id"])) return self::jsonResult(false, "Invalid arguments", 403);

		extract($_POST);
		$res = Cities::deleteC($id);

		if (!$res) return self::jsonResult(false, "Error");
		return self::jsonResult(true, "Deleted.");
	}

	/* Help methods */

	private function checkAccess() {

		if (!isset($_GET['token'])) {
			self::jsonResult(false, "Token missed", 403);
			exit();
		}
		$result = User::status($_GET['token']);
		if (!$result) {
			self::jsonResult(false, "Invalid token", 429);
			exit();
		}
	}

	private function checkBuildingAccess($id) {
		if (!User::checkAccessToBuilding($id, $_GET["token"])) {
			self::jsonResult(false, "У Вас нет доступа для выполнения данной операции.");
			exit();
		}
	}

	private static function checkPointAccess($id) {
		if (!User::checkAccessToPoint($id, $_GET["token"])) {
			self::jsonResult(false, "У Вас нет доступа для выполнения данной операции.");
			exit();
		}	
	}

	private static function checkVectorAccess($id) {
		if (!User::checkAccessToVector($id, $_GET["token"])) {
			self::jsonResult(false, "У Вас нет доступа для выполнения данной операции.");
			exit();
		}	
	}

	private static function checkAliasAccess($id) {
		if (!User::checkAccessToAlias($id, $_GET["token"])) {
			self::jsonResult(false, "У Вас нет доступа для выполнения данной операции.");
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
			self::jsonResult(false, "Access denied!", 429);
			exit();
		}
	}

	public function test() {
		$res = preg_match('/\+[0-9]{11, 15}/', "+79640273064");
		var_dump($res);
	}

}