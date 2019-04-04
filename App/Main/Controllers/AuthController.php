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
			// var_dump($response); die();
			$_SESSION["name"] = $response["name"];
			$_SESSION["token"] = $response["token"];
			$_SESSION["super_user"] = $response["super_user"];

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