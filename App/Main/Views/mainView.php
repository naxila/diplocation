<!DOCTYPE html>
<html>
<head>
	<title>Main Page</title>
	<style type="text/css">
		body {
			background: #eee;
			color: #222;
			font-family: Arial;
		}

		.c_table {
			margin-left: auto;
			margin-right: auto;
			width: 30%;
			background: #fff;
			border: 1px #ccc solid;
			border-radius: 5px;
		}

		.c_table_row {
			display: block;
			padding: 20px;
			border-bottom: 2px #ccc dotted;
			color: #555;
		}

		.c_table_row:hover {
			background-color: #eee;
		}

	</style>
</head>
<body>

<h1>Main Page!!!</h1>

<div class="c_table">
	<?php 
		foreach ($countries as $key => $country) {
			echo "<div class='c_table_row'>Страна $key: ".$country["title"]."</div>";
		}
	?>

</div>

</body>
</html>

