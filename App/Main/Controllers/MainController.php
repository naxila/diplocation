<?php
require_once "App/Main/Models/Dictionary.php";

class MainController extends Controllers {

	public function index() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}
		$countries = Dictionary::Countries();
		self::showView("main", ["countries" => $countries]);

	}

	public function edit() {
		self::showView("edit", []);
	}

	public function logout() {
		session_destroy();
		header("Location: /auth");
	}

}