<?php

class BuildingsController extends Controllers {

	public function index() {
		$countries = ApiService::makeRequest("buildings", "GET", ["city_id" => 1]);
		$countries = $countries["response"];

		self::showView("main", ["countries" => $countries]);
	}

}