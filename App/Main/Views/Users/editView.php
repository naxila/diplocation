<!-- <h3>Редактирование пользователя</h3> -->

<?php 
	$options = [];
	if ($user["super_user"] == 0) {
		$options[] = "<option value='0' selected>Администратор</option>";
		$options[] = "<option value='1'>Суперадминистратор</option>";
	} else {
		$options[] = "<option value='0'>Администратор</option>";
		$options[] = "<option value='1' selected>Суперадминистратор</option>";
	}
?>

	<form action="/admins/savechanges?id=<?=$_GET['id']?>" method="POST" style="width: 80%; margin: 10px;">

	  <div class="form-group">
	    <label for="exampleInputEmail1">Имя пользователя</label>
	    <input type="text" name="name" class="form-control" aria-describedby="emailHelp" placeholder="Введите имя пользователя" value="<?=$user["name"]?>" autocomplete="off">
	  </div>

	  <div class="form-group">
	    <label for="exampleInputPassword1">Логин</label>
	    <input type="text" name="login" class="form-control" placeholder="Введите логин"  value="<?=$user["login"]?>" autocomplete="off">
	  </div>

	  <div class="form-group">
	    <label for="exampleInputPassword1">Новый пароль</label>
	    <input type="text" name="password" class="form-control" placeholder="Введите новый пароль" autocomplete="off">
	    <small id="passwordHelp" class="form-text text-muted">Оставьте это поле пустым, если изменение пароля не требуется</small>
	  </div>

	  <div class="form-group">
	    <label for="exampleInputPassword1">E-mail</label>
	    <input type="text" name="email" class="form-control" placeholder="Введите e-mail"  value="<?=$user["email"]?>" autocomplete="off">
	  </div>

	  <div class="form-group">
	    <label for="exampleInputPassword1">Тип учетной записи</label>
	    <select name="super_user" class="form-control" placeholder="Выберите тип аккаунта"  value="<?=$user["login"]?>" autocomplete="off">
	    	<?=$options[0]?>
	    	<?=$options[1]?>
	    </select>
	  </div>

	  <button type="submit" class="btn btn-primary">Сохранить</button>
	</form>
