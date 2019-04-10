<?php

class User extends Model {

	public static function login($login, $password) {
		$password = md5("ufo".$password."ufo");
		return self::loginWithHash($login, $password);
	}

	public static function loginWithHash($login, $password) {
		$user = self::Query("SELECT * FROM admins WHERE login='$login' AND password='$password'");
		$user = mysqli_fetch_assoc($user);
		if ($user) {
			$user['token'] = self::generateToken($user['id'], $login, $password);
			unset($user["password"]);
			return $user;
		}

		return false;
	}

	public static function getUser($id) {
		$user = self::Query("SELECT * FROM admins WHERE id='$id'");
		$user = mysqli_fetch_assoc($user);
		if ($user) {
			return $user;
		}

		return false;
	}

	// public static function logout($token) {
	// 	self::Delete("access_tokens", ["token" => $token]);
	// 	return true;
	// }

	public function buildingsByUser($id) {
		$buildings = self::Query("SELECT buildings.id, buildings.title, cities.title AS city, buildings.address FROM buildings, admins_buildings, cities WHERE admin_id='$id' AND buildings.city_id=cities.id AND buildings.id=admins_buildings.building_id");

		$result = [];

		while ($building = mysqli_fetch_assoc($buildings)) {
			$result[] = $building;
		}

		return $result;
	}

	public function saveBuildingsToUser($id, $buildings) {
		self::Delete("admins_buildings", ["admin_id" => $id]);

		foreach ($buildings as $key => $value) {
			self::Insert("admins_buildings", ["admin_id" => $id, "building_id" => $value]);
		}

		return true;
	}

	public function getUsers() {
		$users = self::Query("SELECT * FROM admins WHERE id <> '0'");

		$result = [];

		while ($user = mysqli_fetch_assoc($users)) {
			$result[] = $user;
		}

		return $result;
	}

	public function getCurrentAdminBuildings($token) {
		$admin = self::Query("SELECT * FROM access_tokens WHERE token='$token'");
		$admin = mysqli_fetch_assoc($admin);

		if ($admin) {
			return self::buildingsByUser($admin["admin_id"]);
		}

		return false;
	}

	public static function create($data) {

		$data["password"] = md5("ufo" . $data["password"] . "ufo");

		$res = self::Insert("admins", $data);
		// var_dump($res); die();
		return $res;
	}

	public static function deleteUser($id) {

		$res = self::Delete("admins", ["id" => $id]);
		// var_dump($res); die();
		return $res;
	}

	public static function updateUser($data) {
		$id = $data["id"];
		unset($data["id"]);

		if (!isset($data["password"]) || $data["password"] == "") {
			unset($data["password"]);
		} else {
			$data["password"] = md5("ufo" . $data["password"] . "ufo");
		}

		$res = self::Update("admins", $data, ["id" => $id]);
		// var_dump($res); die();
		return $res;
	}

	public static function status($token) {
		$result = self::Query("SELECT * FROM access_tokens WHERE token='$token'");
		$result = mysqli_fetch_assoc($result);
		if ($result != NULL) {

			$userId = $result["admin_id"];

			$Query = self::Query("SELECT * FROM admins WHERE id='$userId'");
			$Query = mysqli_fetch_assoc($Query);

			if ($Query != NULL && $Query["super_user"] == 0) {
				return true;
			}
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

	public static function checkAccessToBuilding($id, $token) {
		$admin = self::Query("SELECT * FROM access_tokens WHERE token='$token'");
		$admin = mysqli_fetch_assoc($admin);

		if ($admin) {
			$building = self::Query("SELECT * FROM admins_buildings WHERE building_id='$id' AND admin_id='$admin[admin_id]'");
			$building = mysqli_fetch_assoc($building);

			if ($building) {
				return true;
			}
		}

		return false;	
	}

	public static function checkAccessToPoint($id, $token) {
		$point = self::Query("SELECT * FROM points WHERE id='$id'");
		$point = mysqli_fetch_assoc($point);

		if ($point) {
			return self::checkAccessToBuilding($point["building_id"], $token);
		}

		return false;	
	}

	public static function checkAccessToVector($id, $token) {
		$vector = self::Query("SELECT * FROM vectors WHERE id='$id'");
		$vector = mysqli_fetch_assoc($vector);

		if ($vector) {
			return self::checkAccessToPoint($vector["start_point"], $token);
		}

		return false;	
	}

	public static function checkAccessToAlias($id, $token) {
		$alias = self::Query("SELECT * FROM points_aliases WHERE id='$id'");
		$alias = mysqli_fetch_assoc($alias);

		if ($alias) {
			return self::checkAccessToPoint($alias["point_id"], $token);
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