<?php 

class Countries extends Model {

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