<?php

class AdminsController extends Controllers {

	public function index() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		$users = ApiService::makeRequest("getUsers", "GET", ["token" => $_SESSION["token"]]);
		if ($users["status"]) {
			$users = $users["response"];
		} else {
			$users = [];
		}

		self::showView("Users/list", ["users" => $users]);

	}

	public function edit() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}

		$user = ApiService::makeRequest("getUser", "GET", ["id" => $_GET["id"], "token" => $_SESSION["token"]]);
		if ($user["status"]) {
			$user = $user["response"];
		} else {
			$users = [];
		}
		
		self::showView("Users/edit", ["user" => $user]);
	}

	public function create() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}
		
		self::showView("Users/create");
	}

	public function save() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		$user = ApiService::makeRequestWithToken("createUser", "POST", $_POST, $_SESSION["token"]);
		if ($user["status"]) {
			header("Location: /");
		} else {
			header("Location: /?error_code=2");
		}
	}

	public function savechanges() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}

		$user = ApiService::makeRequestWithToken("updateUser?id=".$_GET["id"] , "POST", $_POST, $_SESSION["token"]);
		if ($user["status"]) {
			header("Location: /");
		} else {
			header("Location: /?error_code=1");
		}
	}

	public function delete() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}

		$user = ApiService::makeRequestWithToken("deleteUser?id=".$_GET["id"] , "POST", $_POST, $_SESSION["token"]);
		header("Location: /");
	}

	public function buildings() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}


		$user = ApiService::makeRequestWithToken("getUser", "GET", $_GET, $_SESSION["token"]);
		$userBuildings = ApiService::makeRequestWithToken("buildingsByUser", "GET", $_GET, $_SESSION["token"]);
		$buildings = ApiService::makeRequest("allBuildings", "GET", $_GET);
		// var_dump($buildings); die();
		$keys = [];
		foreach ($userBuildings["response"] as $key => $value) {
			$keys[] = $value["id"];
		}

		$userBuildings = $keys;

		self::showView("Users/buildings", ["user" => $user["response"], "userBuildings" => $userBuildings, "buildings" => $buildings["response"]]);
	}

	public function saveBuildings() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}

		// var_dump($_POST); die();

		$res = ApiService::makeRequestWithToken("saveBuildingsToUser?id=".$_GET["id"], "POST", $_POST, $_SESSION["token"]);
		header("Location: /");
	}

}