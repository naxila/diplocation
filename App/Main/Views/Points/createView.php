
	<form action="/points/save?id=<?=$_GET['id']?>" method="POST" style="width: 80%; margin: 10px;">

	  <div class="form-group">
	    <label for="exampleInputEmail1">Название точки</label>
	    <input type="text" name="title" class="form-control" aria-describedby="emailHelp" placeholder="Введите название" autocomplete="off">

	  </div>

	  <div class="form-group">
	    <label for="exampleInputEmail1">ID устройства</label>
	    <input type="text" name="device_id" class="form-control" aria-describedby="emailHelp" placeholder="Введите ID" autocomplete="off">
	  </div>

	  <button type="submit" class="btn btn-primary">Создать</button>
	</form>
