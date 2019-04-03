<?php

class Routes {

	public function Start() {

		$url = $_SERVER['REQUEST_URI'];
		$url = explode("?", $url)[0];
		$url = explode("/", $url);
		//dd($url);
		$Controller = "main";
		$Action = "index";

		// if($url[1]=="auth" || $url[1]=="reg"){
		// 	header("location: /");
		// }

		if (count($url)>0 && !empty($url[1])) {
			$Controller = $url[1];
			if (count($url)>2 && !empty($url[2])) $Action = $url[2]; 
		}

		$ControllerName = ucfirst(strtolower($Controller))."Controller";
		$Path = "App\Main\Controllers\\".$ControllerName.".php";
		$ActionName = ucfirst(strtolower($Action));

		if (isset($url[3])) {
			$_GET['id'] = $url[3];
		}

		if(file_exists($Path)){
			require_once $Path;
			$request = "return ".$ControllerName."::".$ActionName."();";
			eval($request);
		}

		else if(!empty($url[1]) && preg_match("/[^0-9]/", $url[1]) == 0) {
			require_once "App\Main\Controllers\MainController.php";
			MainController::Get($url[1]);
			return false;
		}

		else {
			require_once "App\Main\Controllers\ErrorController.php";
			return ErrorController::E404();
		}
		return ;
	}

}