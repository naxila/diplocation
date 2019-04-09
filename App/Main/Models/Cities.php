<?php

class Cities extends Model {

	public static function get($id) {
		$res = self::Query("SELECT * FROM cities WHERE id='$id'");
		if ($res = mysqli_fetch_assoc($res)) {
			return $res;
		}
		return false;
	}

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