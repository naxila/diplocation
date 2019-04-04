<?php

require_once "App/Main/Controllers/AdminsController.php";
require_once "App/Main/Controllers/BuildingsController.php";

class MainController extends Controllers {

	public function index() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		if ($_SESSION["super_user"] == 1) {
			AdminsController::index();
		} else {
			BuildingsController::index();
		}

	}

	public function logout() {
		session_destroy();
		header("Location: /auth");
	}

}