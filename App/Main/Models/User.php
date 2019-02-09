<?php

class User extends Model {

	public static function login($login, $password) {
		$password = md5("ufo".$password."ufo");
		$user = self::Query("SELECT * FROM admins WHERE login='$login' AND password='$password' OR email='$login' AND password='$password'");
		if ($user) {
			$user = mysqli_fetch_assoc($user);
			$user['token'] = self::generateToken($user['id'], $login, $password);
			return $user;
		}

		return false;
	}

	public static function create($name, $login, $email, $password) {

		$user = self::Query("SELECT * FROM admins WHERE email='$email' OR login='$login'");
		$user = mysqli_fetch_assoc($user);

		if ($user != NULL){
			return false;
		}

		self::Insert("admins", ['name' => $name, 'login' => $LOGIN, 'email' => $email, 'password' => md5("ufo".$password."ufo")]);
		$user = self::Query("SELECT * FROM admins WHERE email='$email' AND login='$phone'");
		$user = mysqli_fetch_assoc($user);
		if ($user != NULL){
			return true;
		}

		return false;
	}

	public static function status($token) {
		$result = self::Query("SELECT * FROM access_tokens WHERE token='$token'");
		$result = mysqli_fetch_assoc($result);
		if ($result != NULL) {
			unset($result['id']);
			return $result;
		}

		return false;
	}

	public static function superStatus($token) {
		$result = self::Query("SELECT * FROM access_tokens WHERE token='$token'");
		$result = mysqli_fetch_assoc($result);
		if ($result != NULL) {

			$userId = $result["admin_id"];

			$Query = self::Query("SELECT * FROM admins WHERE id='$userId'");
			$Query = mysqli_fetch_assoc($Query);

			if ($Query != NULL && $Query["super_user"] == 1) {
				return true;
			}
		}

		return false;
	}

	public static function checkEmail($email) {
		$user = mysqli_fetch_assoc(self::Query("SELECT * FROM admins WHERE email='$email'"));
		if ($user == NULL) return true;
		return false;
	}

	public static function checkLogin($login) {
		$user = mysqli_fetch_assoc(self::Query("SELECT * FROM admins WHERE login='$login'"));
		if ($user == NULL) return true;
		return false;
	}

	/* Help methods */

	public static function generateToken($id, $login, $password) {
		$now = time()/17;
		$token = "access".md5($login.$now.$password.$now);
		self::Insert("access_tokens", ["admin_id" => $id, "token" => $token]);
		return $token;
	}

}