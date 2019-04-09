<?php

class ApiService {


	public static function makeRequest($path, $method, $data = []) {
		$url = 'http://diplocation/api/'.$path;
		$data = $method == "POST" ? json_encode($data) : http_build_query($data);
		if ($method == "GET") $url.="?".$data;

		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => $method,
		        'content' => $method == "POST" ? $data : ""
		    )
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result === FALSE) { var_dump($result); die(); }
		// var_dump($result); die();
		$result = json_decode($result, true);
		return $result;
	}

	public static function makeRequestWithToken($path, $method, $data = [], $token) {
		$url = 'http://diplocation/api/'.$path;
		$data = $method == "POST" ? json_encode($data) : http_build_query($data);

		if ($method == "GET") {
			$url.="?".$data;
		}

		$url.="?&token=$token";

		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => $method,
		        'content' => $method == "POST" ? $data : ""
		    )
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result === FALSE) { var_dump($result); die(); }
		// var_dump($result); die();
		$result = json_decode($result, true);
		return $result;
	}

}