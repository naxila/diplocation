<?php
require_once "App/Main/Models/Dictionary.php";

class MainController extends Controllers {

	public function index() {

		$countries = Dictionary::countries();
		self::showView("main", ["countries" => $countries]);

	}

	public function edit() {
		self::showView("edit", []);
	}

}