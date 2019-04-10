<?php

class AliasesController extends Controllers {

	public function index() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		$buildings = ApiService::makeRequest("aliases", "GET", ["token" => $_SESSION["token"], "point_id" => $_GET["id"]]);
		if ($buildings["status"]) {
			$buildings = $buildings["response"];
		} else {
			$buildings = [];
		}

		self::showView("Aliases/list", ["aliases" => $buildings]);
	}

	public function edit() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}

		$building = ApiService::makeRequest("alias", "GET", ["id" => $_GET["id"], "token" => $_SESSION["token"]]);
		if ($building["status"]) {
			$building = $building["response"];
		} else {
			$building = [];
		}
		
		self::showView("Aliases/edit", ["alias" => $building]);
	}

	public function create() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}
		
		self::showView("Aliases/create");
	}

	public function save() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		$_POST["point_id"] = $_GET["id"];

		$user = ApiService::makeRequestWithToken("addAlias", "POST", $_POST, $_SESSION["token"]);
	
		header("Location: /aliases?id=".$_POST["point_id"]);
		
	}

	public function savechanges() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}

		$_POST["id"] = $_GET["id"];

		$user = ApiService::makeRequestWithToken("updateAlias", "POST", $_POST, $_SESSION["token"]);
		if ($user["status"]) {
			header("Location: /aliases?id=".$_POST["point_id"]);
		} else {
			header("Location: /aliases/?error_code=1&id=".$_POST["point_id"]);
		}
	}

	public function delete() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if (!isset($_GET["id"])) {
			header("Location: /");
		}

		$user = ApiService::makeRequestWithToken("deleteAlias", "POST", $_GET, $_SESSION["token"]);
		header("Location: /aliases?id=".$_GET["point_id"]);
	}


}