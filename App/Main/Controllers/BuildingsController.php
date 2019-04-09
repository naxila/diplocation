<?php

class BuildingsController extends Controllers {

	public function index() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		$buildings = ApiService::makeRequest("buildings", "GET", ["token" => $_SESSION["token"], "city_id" => $_GET["id"]]);
		if ($buildings["status"]) {
			$buildings = $buildings["response"];
		} else {
			$buildings = [];
		}

		self::showView("Buildings/list", ["buildings" => $buildings]);
	}

	public function edit() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}

		$building = ApiService::makeRequest("building", "GET", ["id" => $_GET["id"], "token" => $_SESSION["token"]]);
		if ($building["status"]) {
			$building = $building["response"];
		} else {
			$building = [];
		}
		
		self::showView("Buildings/edit", ["building" => $building]);
	}

	public function create() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}
		
		self::showView("Buildings/create");
	}

	public function save() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		$_POST["city_id"] = $_GET["id"];

		$user = ApiService::makeRequestWithToken("addBuilding", "POST", $_POST, $_SESSION["token"]);
	
		header("Location: /buildings?id=".$_POST["city_id"]);
		
	}

	public function savechanges() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}

		$_POST["id"] = $_GET["id"];

		$user = ApiService::makeRequestWithToken("updateBuilding", "POST", $_POST, $_SESSION["token"]);
		if ($user["status"]) {
			header("Location: /buildings?id=".$_POST["city_id"]);
		} else {
			header("Location: /buildings/?error_code=1&id=".$_POST["city_id"]);
		}
	}

	public function delete() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}

		$user = ApiService::makeRequestWithToken("deleteBuilding", "POST", $_GET, $_SESSION["token"]);
		header("Location: /buildings?id=".$_GET["city_id"]);
	}


}