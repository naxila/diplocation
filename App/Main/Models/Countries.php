<?php 

class Countries extends Model {

	public static function get($id) {
		$res = self::Query("SELECT * FROM countries WHERE id='$id'");
		if ($res = mysqli_fetch_assoc($res)) {
			return $res;
		}
		return false;
	}

	public static function addC($title) {
		self::Insert("countries", ["title"=>$title]);
		return true;
	} 

	public static function updateC($id, $title) {
		self::Update("countries",  ["title"=>$title], ["id"=>$id]);
		return true;
	}

	public static function deleteC($id) {
		self::Delete("countries", ["id"=>$id]);
		return true;
	}


}