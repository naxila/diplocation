<!-- <h3>Редактирование пользователя</h3> -->
<div class="d-flex justify-content-center">
	<form action="/admins/" method="POST" style="width: 80%; margin: 10px;">
	  <div class="form-group">
	    <label for="exampleInputEmail1">Имя пользователя</label>
	    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите имя пользователя" value="<?=$user["name"]?>">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">Логин</label>
	    <input type="text" name="login" class="form-control" id="exampleInputPassword1" placeholder="Введите логин"  value="<?=$user["login"]?>">
	  </div>
	  <button type="submit" class="btn btn-primary">Сохранить</button>
	</form>
</div>