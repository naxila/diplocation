<?php

class Validator {

	public static function flatQueryValidate($in) {
		if (!isset($in['city_id'])) return false;
		if (!isset($in['min_price'])) return false;
		if (!isset($in['max_price'])) return false;
		if (!isset($in['order_by'])) return false;
		if (!isset($in['offset'])) return false;
		if (!isset($in['limit'])) return false;

		return true;
	}

	public static function singInQueryValidate($in) {
		if (!isset($in['name'])) return false;
		if (!isset($in['email'])) return false;
		if (!isset($in['login'])) return false;
		if (!isset($in['password'])) return false;

		// if (!preg_match("/\+[0-9]{11, 15}/", $in['phone'])) return false;
		// if (!preg_match("/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/", $in['email'])) return false;

		return true;
	}

}