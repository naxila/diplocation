
	<form action="/countries/savechanges?id=<?=$_GET['id']?>" method="POST" style="width: 80%; margin: 10px;">

	  <div class="form-group">
	    <label for="exampleInputEmail1">Название страны</label>
	    <input type="text" name="title" class="form-control" aria-describedby="emailHelp" placeholder="Введите название страны" value="<?=$country["title"]?>" autocomplete="off">
	  </div>

	  <button type="submit" class="btn btn-primary">Сохранить</button>
	</form>
