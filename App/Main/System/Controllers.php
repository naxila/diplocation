<?php

require_once "App/Main/System/ApiService.php";

class Controllers {

	public function jsonResult($status, $response = [], $responseCode = 200) {
		$result = ["status" => $status, "response" => $response];
		header('Content-Type: application/json');
		http_response_code($responseCode);
		echo json_encode($result);
		return $status;
	}

	public function showView($view, $data = []) {
		extract($data);
		$rootDir = $_SERVER['DOCUMENT_ROOT'];
		include("App/Main/Views/Layouts/mainLayout.php");
	}

	public function showPage($page) {
		include("App/Main/Views/".$page."View.php");
	}

	public function getApi() {

	}

}
 
?>