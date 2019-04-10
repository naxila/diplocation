<?php
	$startOptions = [];
	$endOptions = [];

	foreach ($points as $key => $point) {
			$startOptions[] = "<option value='".$point["id"]."'>".$point["title"]."</option>";
	}

	foreach ($points as $key => $point) {
		$endOptions[] = "<option value='".$point["id"]."'>".$point["title"]."</option>";
	}

?>


	<form action="/vectors/save?id=<?=$_GET['id']?>" method="POST" style="width: 80%; margin: 10px;">

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
			<input type="text" name="distance" class="form-control" aria-describedby="emailHelp" placeholder="Введите расстояние"autocomplete="off">

		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Направление</label>
			<input type="text" name="direction" class="form-control" aria-describedby="emailHelp" placeholder="Введите направление в градусах" autocomplete="off">
		</div>

		<button type="submit" class="btn btn-primary">Сохранить</button>
	</form>

