<?php

class CitiesController extends Controllers {

	public function index() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		$cities = ApiService::makeRequest("cities", "GET", ["token" => $_SESSION["token"], "country_id" => $_GET["id"]]);
		if ($cities["status"]) {
			$cities = $cities["response"];
		} else {
			$cities = [];
		}

		self::showView("Cities/list", ["cities" => $cities]);
	}

	public function edit() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}

		$city = ApiService::makeRequest("city", "GET", ["id" => $_GET["id"], "token" => $_SESSION["token"]]);
		if ($city["status"]) {
			$city = $city["response"];
		} else {
			$city = [];
		}
		
		self::showView("Cities/edit", ["city" => $city]);
	}

	public function create() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}
		
		self::showView("Cities/create");
	}

	public function save() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		$_POST["country_id"] = $_GET["id"];

		$user = ApiService::makeRequestWithToken("addCity", "POST", $_POST, $_SESSION["token"]);
		if ($user["status"]) {
			header("Location: /cities?id=".$_POST["country_id"]);
		} else {
			header("Location: /?error_code=2&id=".$_POST["country_id"]);
		}
	}

	public function savechanges() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}

		$_POST["id"] = $_GET["id"];

		$user = ApiService::makeRequestWithToken("updateCity", "POST", $_POST, $_SESSION["token"]);
		if ($user["status"]) {
			header("Location: /cities?id=".$_POST["country_id"]);
		} else {
			header("Location: /?error_code=1&id=".$_POST["country_id"]);
		}
	}

	public function delete() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}

		$user = ApiService::makeRequestWithToken("deleteCity", "POST", $_GET, $_SESSION["token"]);
		header("Location: /cities?id=".$_GET["country_id"]);
	}

}