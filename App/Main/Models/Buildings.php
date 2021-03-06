<?php

class Buildings extends Model {

	public static function get($id) {
		$res = self::Query("SELECT * FROM buildings WHERE id='$id'");
		if ($res = mysqli_fetch_assoc($res)) {
			return $res;
		}
		return false;
	}

	public static function addB($title, $city_id, $address) {
		$building = self::Query("INSERT INTO buildings (title, city_id, address) VALUES ('$title', '$city_id', '$address')");
		$result = mysqli_affected_rows($building);

		if (!$result) {
			return true;
		}

		return false;
	}

	public static function updateB($id, $title, $city_id, $address) {
		self::Update("buildings", ["title"=>$title, "city_id"=>$city_id, "address"=>$address], ["id"=>$id]);
		return true;
	}

	public static function deleteB($id) {
		self::Delete("buildings", ["id"=>$id]);
		return true;
	}

}