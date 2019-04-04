<?php

class AdminsController extends Controllers {

	public function index() {

		if (!isset($_SESSION["name"]) || !isset($_SESSION["token"])) {
			header("Location: /auth");
		}

		$users = ApiService::makeRequest("getUsers", "GET", ["token" => $_SESSION["token"]]);
		self::showView("usersList", ["users" => $users]);

	}

}