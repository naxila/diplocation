<?php
	$startOptions = [];
	$endOptions = [];

	foreach ($points as $key => $point) {
		if ($vector["start_point"] == $point["id"]) {
			$startOptions[] = "<option value='".$point["id"]."' selected>".$point["title"]."</option>";
		} else {
			$startOptions[] = "<option value='".$point["id"]."'>".$point["title"]."</option>";
		}
	}

	foreach ($points as $key => $point) {
		if ($vector["end_point"] == $point["id"]) {
			$endOptions[] = "<option value='".$point["id"]."' selected>".$point["title"]."</option>";
		} else {
			$endOptions[] = "<option value='".$point["id"]."'>".$point["title"]."</option>";
		}
	}

?>


	<form action="/vectors/savechanges?id=<?=$_GET['id']?>" method="POST" style="width: 80%; margin: 10px;">

		<div class="form-group">
		    <label for="exampleInputEmail1">Начальная точка</label>
		    <select name="start_point" class="form-control" aria-describedby="emailHelp" placeholder="Выберите точку">
		    	<?php foreach ($startOptions as $key => $value) { ?>
		    		<?=$value?>
		    	<?php } ?>
		    </select>
	  	</div>

	  	<div class="form-group">
		    <label for="exampleInputEmail1">Конечная точка</label>
		    <select name="end_point" class="form-control" aria-describedby="emailHelp" placeholder="Выберите точку">
		    	<?php foreach ($endOptions as $key => $value) { ?>
		    		<?=$value?>
		    	<?php } ?>
		    </select>
	  	</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Расстояние</label>
			<input type="text" name="distance" class="form-control" aria-describedby="emailHelp" placeholder="Введите расстояние" value="<?=$vector["distance"]?>" autocomplete="off">
			<input type="text" name="building_id" value="<?=$vector["building_id"]?>" autocomplete="off" hidden>

		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Направление</label>
			<input type="text" name="direction" class="form-control" aria-describedby="emailHelp" placeholder="Введите направление в градусах" value="<?=$vector["direction"]?>" autocomplete="off">
		</div>

		<button type="submit" class="btn btn-primary">Сохранить</button>
	</form>
