<?php

class Flat extends Model {

	public static function get($city_id, $min_price, $max_price, $order_by, $limit, $offset) {
		$orders = ["ASC", "DESC"];
		$order_by = $orders[$order_by];
		$query = self::Query("SELECT * FROM flats WHERE city_id='$city_id' AND price BETWEEN '$min_price' AND '$max_price' ORDER BY price $order_by LIMIT $offset, $limit");

		if ($query) {
			$result = [];

			while ($row = mysqli_fetch_assoc($query)) {
				$flat_id = $row['id'];
				$photosArray = [];
				$photos = self::Query("SELECT * FROM photos WHERE flat_id='$flat_id'");

				while ($image = mysqli_fetch_assoc($photos)) {
					$photosArray[] = "/images/".$image['path'];
				}
				
				$row['photos'] = $photosArray;
				$result[] = $row;
			}

			return $result;
		}

		return false;

	} 

}