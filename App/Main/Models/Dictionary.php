<?php

class Dictionary extends Model {

	public function map($building_id) {
		$query = self::Query("SELECT * FROM points WHERE building_id='$building_id'");

		if ($query) {
			$points = [];
			while ($row = mysqli_fetch_assoc($query)) {
				// self::ddlog($row);

				$point_id = $row["id"];
				$vectors = [];
				$vector_query = self::Query("SELECT * FROM vectors WHERE start_point='$point_id' OR end_point='$point_id'");

				if ($vector_query) {
					while ($vector_row = mysqli_fetch_assoc($vector_query)) {
						$vectors[] = $vector_row;
					}	
				}

				$row["vectors"] = $vectors;
				$points[] = $row;
			}
			return $points;
		}

		return false;
	}

	public function buildings($city_id) {
		$query = self::Query("SELECT buildings.id, buildings.title, buildings.address, cities.title AS city FROM buildings, cities WHERE buildings.city_id=cities.id AND buildings.city_id='$city_id'");

		if ($query) {
			$buildings = [];
			while ($row = mysqli_fetch_assoc($query)) {
				$buildings[] = $row;
			}
			return $buildings;
		}

		return false;
	}

	public function allBuildings() {
		$query = self::Query("SELECT buildings.id, buildings.title, buildings.address, cities.title AS city FROM buildings, cities WHERE buildings.city_id=cities.id");

		if ($query) {
			$buildings = [];
			while ($row = mysqli_fetch_assoc($query)) {
				$buildings[] = $row;
			}
			return $buildings;
		}

		return false;
	}

	public function cities($country_id) {
		
		$query = self::Query("SELECT * FROM cities WHERE country_id='$country_id'");

		if ($query) {
			$cities = [];
			while ($row = mysqli_fetch_assoc($query)) {
				$cities[] = $row;
			}
			return $cities;
		}

		return false;
	}

	public function points($building_id) {
		
		$query = self::Query("SELECT points.id, points.title, points.device_id, admins.name AS editor, points.last_update FROM points, admins WHERE building_id='$building_id' AND admins.id=points.edited_by ORDER BY points.last_update DESC");

		if ($query) {
			$points = [];
			while ($row = mysqli_fetch_assoc($query)) {
				$points[] = $row;
			}
			return $points;
		}

		return false;
	}

	public function vectors($building_id) {
		
		$query = self::Query("SELECT * FROM vectors WHERE building_id='$building_id'");

		if ($query) {
			$vectors = [];
			while ($row = mysqli_fetch_assoc($query)) {
				$vectors[] = $row;
			}
			return $vectors;
		}

		return false;
	}

	public function aliases($point_id) {
		
		$query = self::Query("SELECT * FROM aliases WHERE point_id='$point_id'");

		if ($query) {
			$aliases = [];
			while ($row = mysqli_fetch_assoc($query)) {
				$aliases[] = $row;
			}
			return $aliases;
		}

		return false;
	}

	public function countries() {
		$query = self::Query("SELECT * FROM countries");

		if ($query) {
			$countries = [];
			while ($row = mysqli_fetch_assoc($query)) {
				$countries[] = $row;
			}
			return $countries;
		}

		return false;
	}

	public function getCountry($id) {
		$query = self::Query("SELECT * FROM countries WHERE id='$id'");
		$query = mysqli_fetch_assoc($query);
		if ($query) {
			return $query;
		}

		return false;
	}

	public function getCity($id) {
		$query = self::Query("SELECT * FROM cities WHERE id='$id'");
		$query = mysqli_fetch_assoc($query);
		if ($query) {
			return $query;
		}

		return false;
	}

	public function getBuilding($id) {
		$query = self::Query("SELECT * FROM buildings WHERE id='$id'");
		$query = mysqli_fetch_assoc($query);
		if ($query) {
			return $query;
		}

		return false;
	}

	public function getPoint($id) {
		$query = self::Query("SELECT * FROM points WHERE id='$id'");
		$query = mysqli_fetch_assoc($query);
		if ($query) {
			return $query;
		}

		return false;
	}

	public function getVector($id) {
		$query = self::Query("SELECT * FROM vectors WHERE id='$id'");
		$query = mysqli_fetch_assoc($query);
		if ($query) {
			return $query;
		}

		return false;
	}

	public function getAlias($id) {
		$query = self::Query("SELECT * FROM aliases WHERE id='$id'");
		$query = mysqli_fetch_assoc($query);
		if ($query) {
			return $query;
		}

		return false;
	}

}