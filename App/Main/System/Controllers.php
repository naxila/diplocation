<?php

class Controllers {

	public function jsonResult($status, $response = [], $responseCode = 200) {
		$result = ["status" => $status, "response" => $response];
		header('Content-Type: application/json');
		http_response_code($responseCode);
		echo json_encode($result);
		return $status;
	}

	public function showView($view, $data) {
		extract($data);
		include("App/Main/Views/Layouts/mainLayout.php");
	}
}
 
?>