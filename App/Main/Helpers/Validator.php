<?php

class Validator {

	public static function singInQueryValidate($in) {
		if (!isset($in['name'])) return false;
		if (!isset($in['email'])) return false;
		if (!isset($in['login'])) return false;
		if (!isset($in['password'])) return false;

		// if (!preg_match("/\+[0-9]{11, 15}/", $in['phone'])) return false;
		// if (!preg_match("/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/", $in['email'])) return false;

		return true;
	}

	public static function addPointQueryValidate($in) {
		if (!isset($in['device_id'])) return false;
		if (!isset($in['title'])) return false;
		if (!isset($in['building_id'])) return false;
		return true;
	}

	public static function updatePointQueryValidate($in) {
		if (!isset($in['id'])) return false;
		if (!isset($in['device_id'])) return false;
		if (!isset($in['title'])) return false;
		if (!isset($in['building_id'])) return false;
		return true;
	}

	public static function addVectorQueryValidate($in) {
		if (!isset($in['building_id'])) return false;
		if (!isset($in['start_point'])) return false;
		if (!isset($in['end_point'])) return false;
		if (!isset($in['distance'])) return false;
		if (!isset($in['direction'])) return false;
		return true;
	}

	public static function updateVectorQueryValidate($in) {
		if (!isset($in['id'])) return false;
		if (!isset($in['building_id'])) return false;
		if (!isset($in['start_point'])) return false;
		if (!isset($in['end_point'])) return false;
		if (!isset($in['distance'])) return false;
		if (!isset($in['direction'])) return false;
		return true;
	}

}