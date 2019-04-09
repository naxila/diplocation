<?php

class BuildingsController extends Controllers {

	public function index() {
		$countries = ApiService::makeRequestWithToken("myBuildings", "GET", [], $_SESSION["token"]);
		$countries = $countries["response"];
		// var_dump($countries); die();
		self::showView("main", ["countries" => $countries]);
	}

}