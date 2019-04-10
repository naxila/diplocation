<?php

class Database {

	public static $mysqli = null;

	public function Connect() {
		$config = parse_ini_file('App/Core/DB.ini');
		self::$mysqli = new mysqli($config['SERVER'], $config['USER'], $config['PASSWORD'], $config['DATABASE']);
		self::$mysqli->set_charset("utf8");
		return self::$mysqli;
	}

	public function Query($query) {
		self::Connect();
		// echo $query."<br><p><br>";
		return self::$mysqli->query($query);
	}

	public function Insert($table, $data) {
		$data = (array)$data;
		$query = "INSERT INTO $table (";

		$i = 0;
		$len = count($data)-1;

		foreach ($data as $atr => $value) {
			if ($i == $len) $query.="$atr";
			else $query.="$atr,";
			$i++;
		}

		$query.=") VALUES (";

		$i = 0;
		foreach ($data as $atr => $value) {
			if ($i == $len) $query.="'$value'";
			else $query.="'$value',";
			$i++;
		}

		$query.=")";

		// dd($query);
		return self::Query($query);
	}

	public function InsertI($table, $data) {
		self::Insert($table, $data);
		return self::$mysqli;
	}

	public function Update($table, $data, $clause = []) {
		$data = (array)$data;		
		$query = "UPDATE $table SET ";

		$i = 0;
		$len = count($data)-1;

		foreach ($data as $atr => $value) {
			if ($i == $len) $query.="$atr = '$value'";
			else $query.="$atr = '$value', ";
			$i++;
		}

		$i = 0;
		

		if (count($clause)>0) {
			$len2 = count($clause)-1;
			$query.=" WHERE ";
			foreach ($clause as $atr => $value) {
				if ($i == $len2) { $query.="$atr = '$value'"; }
				else { $query.="$atr = '$value' AND "; }
				$i++;
			}
		}
		// var_dump($query); die();
		return self::Query($query);
	}

	public function Delete($table, $clause = []) {	
		$query = "DELETE FROM $table";

		if (count($clause)>0) {
			$len2 = count($clause)-1;
			$query.=" WHERE ";
			foreach ($clause as $atr => $value) {
				if ($i == $len2) { $query.="$atr = '$value'"; }
				else { $query.="$atr = '$value' AND "; }
				$i++;
			}
		}
		//dd($query);
		return self::Query($query);
	}

}

?>