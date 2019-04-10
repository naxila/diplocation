<?php

class PointsController extends Controllers {

	public function index() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		$points = ApiService::makeRequest("points", "GET", ["token" => $_SESSION["token"], "building_id" => $_GET["id"]]);
		if ($points["status"]) {
			$points = $points["response"];
		} else {
			$points = [];
		}

		self::showView("Points/list", ["points" => $points]);
	}

	public function edit() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}

		$point = ApiService::makeRequest("point", "GET", ["id" => $_GET["id"], "token" => $_SESSION["token"]]);
		if ($point["status"]) {
			$point = $point["response"];
		} else {
			$point = [];
		}
		
		self::showView("Points/edit", ["point" => $point]);
	}

	public function create() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}
		
		self::showView("Points/create");
	}

	public function save() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		$_POST["building_id"] = $_GET["id"];

		$user = ApiService::makeRequestWithToken("addPoint", "POST", $_POST, $_SESSION["token"]);
	
		header("Location: /points?id=".$_POST["building_id"]);
		
	}

	public function savechanges() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}

		$_POST["id"] = $_GET["id"];

		$user = ApiService::makeRequestWithToken("updatePoint", "POST", $_POST, $_SESSION["token"]);
		if ($user["status"]) {
			header("Location: /points?id=".$_POST["building_id"]);
		} else {
			header("Location: /buildings/?error_code=1&id=".$_POST["building_id"]);
		}
	}

	public function delete() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}

		$user = ApiService::makeRequestWithToken("deletePoint", "POST", $_GET, $_SESSION["token"]);
		header("Location: /points?id=".$_GET["building_id"]);
	}


}