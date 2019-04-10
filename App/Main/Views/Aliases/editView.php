
	<form action="/aliases/savechanges?id=<?=$_GET['id']?>" method="POST" style="width: 80%; margin: 10px;">

	  <div class="form-group">
	    <label for="exampleInputEmail1">Название</label>
	    <input type="text" name="title" class="form-control" aria-describedby="emailHelp" placeholder="Введите название" value="<?=$alias["title"]?>" autocomplete="off">
	    <input type="text" name="point_id" value="<?=$alias["point_id"]?>" autocomplete="off" hidden>

	  </div>

	  <button type="submit" class="btn btn-primary">Сохранить</button>
	</form>
