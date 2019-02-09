<?php

class Map extends Model {

	/* Work with Points */

	public static function addPoint($deviceId, $title, $buildingId) {

		self::Insert("points", ["device_id" => $deviceId, "title" => $title, "building_id" => $buildingId]);
		$point = self::Query("SELECT * FROM points WHERE device_id='$deviceId'");
		$point = mysqli_fetch_assoc($point);
		if ($point != NULL){
			return true;
		}

		return false;
	}

	public static function updatePoint($id, $deviceId, $title, $buildingId) {
		self::Update("points", ["device_id" => $deviceId, "title" => $title, "building_id" => $buildingId], ["id" => $id]);
		return true;
	}

	public static function deletePoint($id) {
		self::Delete("points", ["id" => $id]);
		return true;
	}



	/* Work with Aliases */

	public static function addAlias($pointId, $title) {

		self::Insert("points_aliases", ["point_id" => $pointId, "title" => $title]);
		$alias = self::Query("SELECT * FROM points_aliases WHERE point_id='$pointId' AND title='$title'");
		$alias = mysqli_fetch_assoc($alias);
		if ($alias != NULL){
			return true;
		}

		return false;
	}

	public static function updateAlias($id, $title) {
		self::Update("points_aliases", ["title" => $title], ["id" => $id]);
		return true;
	}

	public static function deleteAlias($id) {
		self::Delete("points_aliases", ["id" => $id]);
		return true;
	}



	/* Work with Vectors */

	public static function addVector($startPoint, $endPoint, $distance, $direction) {

		self::Insert("Vectors", ["start_point" => $start_point, "end_point" => $endPoint, "distance" => $distance, "direction" => $direction]);
		$vector = self::Query("SELECT * FROM points WHERE start_point='$startPoint' AND end_point='$endPoint'");
		$vector = mysqli_fetch_assoc($vector);
		if ($vector != NULL){
			return true;
		}

		return false;
	}

	public static function updateVector($id, $startPoint, $endPoint, $distance, $direction) {
		self::Update("Vectors", ["start_point" => $start_point, "end_point" => $endPoint, "distance" => $distance, "direction" => $direction], ["id" => $id]);
		return true;
	}

	public static function deleteVector($id) {
		self::Delete("Vectors", ["id" => $id]);
		return true;
	}

}