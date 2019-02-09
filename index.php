<?php
	session_start();
	require_once "App\Core\Routes.php";
	require_once "App\Main\System\Database.php";
	require_once 'App\Main\System\Model.php';
	require_once 'App\Main\System\Controllers.php';

	return Routes::Start();

?>