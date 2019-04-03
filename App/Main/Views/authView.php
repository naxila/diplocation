<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="">
	<link rel="icon" href="/Styles/images/favicon.ico">
	<title>DipLocation - Авторизация</title>

    <!-- Bootstrap core CSS -->
    <link href="/Styles/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Icons -->
    <link href="/Styles/css/font-awesome.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="/Styles/css/style.css" rel="stylesheet">
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="/Styles/dist/js/bootstrap.min.js"></script>
    
</head>
<body>

	<?php if (isset($_GET["error"]) && $_GET["error"] == "invalid_password") { ?>
		<div class="alert alert-danger">
		  <strong>Ошибка.</strong> Неправильный логин или пароль
		</div>
	<?php } ?>
	<div class="d-flex justify-content-center">
		<form action="/auth/submit" method="POST" style="width: 40%; margin: 40px;">
		  <div class="form-group">
		    <label for="exampleInputEmail1">Ваш логин</label>
		    <input type="login" name="login" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите ваш логин">
		    <small id="emailHelp" class="form-text text-muted">Ваш логин в системе, выданный администратором</small>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Ваш пароль</label>
		    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Пароль">
		  </div>
		  <button type="submit" class="btn btn-primary">Войти</button>
		</form>
	</div>
</body>
</html>