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

}