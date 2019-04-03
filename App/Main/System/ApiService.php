<?php

class ApiService {


	public static function makeRequest($path, $method, $data = []) {
		$url = 'http://diplocation/api/'.$path;
		$data = $method == "POST" ? json_encode($data) : http_build_query($data);

		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => $method,
		        'content' => $data
		    )
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result === FALSE) { var_dump($result); die(); }
		$result = json_decode($result, true);

		return $result;
	}


}