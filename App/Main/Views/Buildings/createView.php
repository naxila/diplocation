
	<form action="/buildings/save?id=<?=$_GET['id']?>" method="POST" style="width: 80%; margin: 10px;">

	  <div class="form-group">
	    <label for="exampleInputEmail1">Название здания</label>
	    <input type="text" name="title" class="form-control" aria-describedby="emailHelp" placeholder="Введите название" autocomplete="off">
	  </div>

	  <div class="form-group">
	    <label for="exampleInputEmail1">Адрес</label>
	    <input type="text" name="address" class="form-control" aria-describedby="emailHelp" placeholder="Введите адрес" autocomplete="off">
	  </div>

	  <button type="submit" class="btn btn-primary">Создать</button>
	</form>
