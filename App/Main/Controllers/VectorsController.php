<?php

class VectorsController extends Controllers {

	public function index() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		$vectors = ApiService::makeRequest("vectors", "GET", ["token" => $_SESSION["token"], "building_id" => $_GET["id"]]);
		if ($vectors["status"]) {
			$vectors = $vectors["response"];
		} else {
			$vectors = [];
		}

		self::showView("Vectors/list", ["vectors" => $vectors]);
	}

	public function edit() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}

		$vector = ApiService::makeRequest("vector", "GET", ["id" => $_GET["id"], "token" => $_SESSION["token"]]);
		$points = ApiService::makeRequest("points", "GET", ["building_id" => $_GET["building_id"], "token" => $_SESSION["token"]]);
		if ($vector["status"]) {
			$vector = $vector["response"];
		} else {
			$vector = [];
		}
		// var_dump($points); die();
		self::showView("Vectors/edit", ["vector" => $vector, "points" => $points["response"]]);
	}

	public function create() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		$points = ApiService::makeRequest("points", "GET", ["building_id" => $_GET["id"], "token" => $_SESSION["token"]]);
		$points = $points["response"];
		
		self::showView("Vectors/create", ["points" => $points]);
	}

	public function save() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		$_POST["building_id"] = $_GET["id"];

		$user = ApiService::makeRequestWithToken("addVector", "POST", $_POST, $_SESSION["token"]);
	
		header("Location: /vectors?id=".$_POST["building_id"]);
		
	}

	public function savechanges() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}

		$_POST["id"] = $_GET["id"];

		// var_dump($_POST); die();

		$user = ApiService::makeRequestWithToken("updateVector", "POST", $_POST, $_SESSION["token"]);
		if ($user["status"]) {
			header("Location: /vectors?id=".$_POST["building_id"]);
		} else {
			header("Location: /vectors/?error_code=1&id=".$_POST["building_id"]);
		}
	}

	public function delete() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}

		$user = ApiService::makeRequestWithToken("deleteVector", "POST", $_GET, $_SESSION["token"]);
		header("Location: /vectors?id=".$_GET["building_id"]);
	}


}