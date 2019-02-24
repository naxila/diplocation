<?php
require_once "App/Main/Models/Dictionary.php";

class MainController extends Controllers {

	public function index(){

		$countries = Dictionary::countries();
		include("App/Main/Views/mainView.php");

	}

}