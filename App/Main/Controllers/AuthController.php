<?php

class AuthController extends Controllers {

	public function index() {

		self::checkAuth();
		self::showPage("auth");
		
	}

	public function submit() {

		self::checkAuth();

		$request = ApiService::makeRequest("loginWeb", "POST", $_POST);

		if ($request["status"]) {

			$response = $request["response"];
			$_SESSION["name"] = $response["name"];
			$_SESSION["token"] = $response["token"];

			header("Location: /");

		} else {
			header("Location: /auth?error=invalid_password");
		}
	}

	private function checkAuth() {
		if (isset($_SESSION["name"]) && isset($_SESSION["token"])) {
			header("Location: /");
		}
	}

}