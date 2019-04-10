
	<form action="/buildings/savechanges?id=<?=$_GET['id']?>" method="POST" style="width: 80%; margin: 10px;">

	  <div class="form-group">
	    <label for="exampleInputEmail1">Название здания</label>
	    <input type="text" name="title" class="form-control" aria-describedby="emailHelp" placeholder="Введите название" value="<?=$building["title"]?>" autocomplete="off">
	    <input type="text" name="city_id" value="<?=$building["city_id"]?>" autocomplete="off" hidden>

	  </div>

	  <div class="form-group">
	    <label for="exampleInputEmail1">Адрес</label>
	    <input type="text" name="address" class="form-control" aria-describedby="emailHelp" placeholder="Введите адрес" value="<?=$building["address"]?>" autocomplete="off">
	  </div>

	  <button type="submit" class="btn btn-primary">Сохранить</button>
	</form>
