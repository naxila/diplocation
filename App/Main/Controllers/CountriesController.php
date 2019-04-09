<?php

class CountriesController extends Controllers {

	public function index() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		$countries = ApiService::makeRequest("countries", "GET", ["token" => $_SESSION["token"]]);
		if ($countries["status"]) {
			$countries = $countries["response"];
		} else {
			$countries = [];
		}

		self::showView("Countries/list", ["countries" => $countries]);

	}

	public function edit() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /countries");
		}

		$country = ApiService::makeRequest("country", "GET", ["id" => $_GET["id"], "token" => $_SESSION["token"]]);
		// var_dump($country); die();
		if ($country["status"]) {
			$country = $country["response"];
		} else {
			$country = [];
		}


		self::showView("Countries/edit", ["country" => $country]);
	}

	public function create() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}
		
		self::showView("Countries/create");
	}

	public function save() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		$user = ApiService::makeRequestWithToken("addCountry", "POST", $_POST, $_SESSION["token"]);
		if ($user["status"]) {
			header("Location: /countries");
		} else {
			header("Location: /?error_code=2");
		}
	}

	public function savechanges() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /countries");
		}

		$_POST["id"] = $_GET["id"];

		$user = ApiService::makeRequestWithToken("updateCountry", "POST", $_POST, $_SESSION["token"]);
		if ($user["status"]) {
			header("Location: /countries");
		} else {
			header("Location: /?error_code=1");
		}
	}

	public function delete() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /countries");
		}

		$user = ApiService::makeRequestWithToken("deleteCountry", "POST", $_GET, $_SESSION["token"]);
		header("Location: /countries");
	}

}