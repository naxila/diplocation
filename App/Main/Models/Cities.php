<?php

class Cities extends Model {

	public static function addC($title, $country_id) {
		self::Insert("cities", ["title"=>$title, "country_id"=>$country_id]);
		return true;
	} 

	public static function updateC($id, $title, $country_id) {
		self::Update("cities",  ["title"=>$title, "country_id"=>$country_id], ["id"=>$id]);
		return true;
	}

	public static function deleteC($id) {
		self::Delete("cities", ["id"=>$id]);
		return true;
	}

}