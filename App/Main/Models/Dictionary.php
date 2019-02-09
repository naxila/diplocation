<?php

class Dictionary extends Model {

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