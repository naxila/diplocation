
	<form action="/cities/save?id=<?=$_GET['id']?>" method="POST" style="width: 80%; margin: 10px;">

	  <div class="form-group">
	    <label for="exampleInputEmail1">Название города</label>
	    <input type="text" name="title" class="form-control" aria-describedby="emailHelp" placeholder="Введите сазвание страны" autocomplete="off">
	  </div>

	  <button type="submit" class="btn btn-primary">Создать</button>
	</form>