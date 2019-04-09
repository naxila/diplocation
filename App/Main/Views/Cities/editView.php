
	<form action="/cities/savechanges?id=<?=$_GET['id']?>" method="POST" style="width: 80%; margin: 10px;">

	  <div class="form-group">
	    <label for="exampleInputEmail1">Название города</label>
	    <input type="text" name="title" class="form-control" aria-describedby="emailHelp" placeholder="Введите сазвание страны" value="<?=$city["title"]?>" autocomplete="off">
	    <input type="text" name="country_id" value="<?=$city["country_id"]?>" autocomplete="off" hidden>

	  </div>

	  <button type="submit" class="btn btn-primary">Сохранить</button>
	</form>
