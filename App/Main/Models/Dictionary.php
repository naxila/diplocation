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
		$query = self::Query("SELECT * FROM buildings WHERE city_id='$city_id'");

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

}