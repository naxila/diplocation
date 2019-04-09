<!-- <h3>Редактирование пользователя</h3> -->

<?php 

	$options[] = "<option value='0' >Администратор</option>";
	$options[] = "<option value='1'>Суперадминистратор</option>";

?>

	<form action="/admins/save" method="POST" style="width: 80%; margin: 10px;">

	  <div class="form-group">
	    <label for="exampleInputEmail1">Имя пользователя</label>
	    <input type="text" name="name" class="form-control" aria-describedby="emailHelp" placeholder="Введите имя пользователя" autocomplete="off">
	  </div>

	  <div class="form-group">
	    <label for="exampleInputPassword1">Логин</label>
	    <input type="text" name="login" class="form-control" placeholder="Введите логин" autocomplete="off">
	  </div>

	  <div class="form-group">
	    <label for="exampleInputPassword1">Пароль</label>
	    <input type="text" name="password" class="form-control" placeholder="Введите пароль" autocomplete="off">
	    <small id="passwordHelp" class="form-text text-muted">Придумайте пароль, который будет передан администратору</small>
	  </div>

	  <div class="form-group">
	    <label for="exampleInputPassword1">E-mail</label>
	    <input type="text" name="email" class="form-control" placeholder="Введите e-mail" autocomplete="off">
	  </div>

	  <div class="form-group">
	    <label for="exampleInputPassword1">Тип учетной записи</label>
	    <select name="super_user" class="form-control" placeholder="Выберите тип аккаунта">
	    	<?=$options[0]?>
	    	<?=$options[1]?>
	    </select>
	  </div>

	  <button type="submit" class="btn btn-primary">Создать</button>
	</form>
