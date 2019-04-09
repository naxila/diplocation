<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="/Styles/images/favicon.ico">
	<title>DipLocation</title>

    <!-- Bootstrap core CSS -->
    <link href="/Styles/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Icons -->
    <link href="/Styles/css/font-awesome.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="/Styles/css/style.css" rel="stylesheet">
    
</head>
<body>
	<div class="container-fluid" id="wrapper">
		<div class="row">
			<nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2">
				<h1 class="site-title"><a href="/"><em class="fa fa-rocket"></em> Diplocation</a></h1>
													
				<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fa fa-bars"></em></a>
				<ul class="nav nav-pills flex-column sidebar-nav">

					<?php if ($_SESSION["super_user"] == 1) { ?>

					<li class="nav-item"><a class="nav-link active" href="/"><em class="fa fa-dashboard"></em> Пользователи <span class="sr-only">(current)</span></a></li>
					<li class="nav-item"><a class="nav-link" href="/countries/"><em class="fa fa-calendar-o"></em> Страны</a></li>
					<!-- <li class="nav-item"><a class="nav-link" href="#"><em class="fa fa-bar-chart"></em> Города</a></li>
					<li class="nav-item"><a class="nav-link" href="#"><em class="fa fa-hand-o-up"></em> Здания</a></li> -->

					<?php } ?>

					<?php if ($_SESSION["super_user"] == 0) { ?>

					<li class="nav-item"><a class="nav-link active" href="/"><em class="fa fa-dashboard"></em> Мои здания <span class="sr-only">(current)</span></a></li>

					<?php } ?>

					<!-- <li class="nav-item"><a class="nav-link active" href="index.html"><em class="fa fa-dashboard"></em> Dashboard <span class="sr-only">(current)</span></a></li>
					<li class="nav-item"><a class="nav-link" href="widgets.html"><em class="fa fa-calendar-o"></em> Widgets</a></li>
					<li class="nav-item"><a class="nav-link" href="charts.html"><em class="fa fa-bar-chart"></em> Charts</a></li>
					<li class="nav-item"><a class="nav-link" href="buttons.html"><em class="fa fa-hand-o-up"></em> Buttons</a></li>
					<li class="nav-item"><a class="nav-link" href="forms.html"><em class="fa fa-pencil-square-o"></em> Forms</a></li>
					<li class="nav-item"><a class="nav-link" href="cards.html"><em class="fa fa-clone"></em> Cards</a></li> -->
				</ul>
				<a href="/main/logout" class="logout-button"><em class="fa fa-power-off"></em> Выйти</a>
			</nav>
			<main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">
				<header class="page-header row justify-center">
					<div class="col-md-6 col-lg-8" >
						<h1 class="float-left text-center text-md-left">Панель управления</h1>
					</div>
					<div class="dropdown user-dropdown col-md-6 col-lg-4 text-center text-md-right"><a class="btn btn-stripped dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="/Styles/images/profile-pic.jpg" alt="profile photo" class="circle float-left profile-photo" width="50" height="auto">
						<div class="username mt-1">
							<h4 class="mb-1"><?=$_SESSION["name"]?></h4>
							<h6 class="text-muted"><?=$_SESSION["super_user"] == 1 ? "Администратор системы" : "Администратор"?></h6>
						</div>
						</a>
						<div class="dropdown-menu dropdown-menu-right" style="margin-right: 1.5rem;" aria-labelledby="dropdownMenuLink"><a class="dropdown-item" href="#"><em class="fa fa-user-circle mr-1"></em> Мои здания</a>
						     <a class="dropdown-item" href="#"><em class="fa fa-sliders mr-1"></em> Настройки</a>
						     <a class="dropdown-item" href="/main/logout"><em class="fa fa-power-off mr-1"></em> Выйти</a></div>
					</div>
					<div class="clear"></div>
				</header>
					<?php if (isset($_GET["error_code"]) && $_GET["error_code"] == 1) { ?>
						<div class="alert alert-danger">
						  <strong>Ошибка.</strong> Не удалось сохранить изменения.
						</div>
					<?php } ?>

					<?php if (isset($_GET["error_code"]) && $_GET["error_code"] == 2) { ?>
						<div class="alert alert-danger">
						  <strong>Ошибка.</strong> Не удалось добавить запись.
						</div>
					<?php } ?>

				<section class="row">
					

					<?php include("App/Main/Views/".$view."View.php"); ?>
				</section>
			</main>
		</div>
	</div>

    <!-- Bootstrap core JavaScript
    ==================================================
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="/Styles/dist/js/bootstrap.min.js"></script>
    
    <script src="/Styles/js/chart.min.js"></script>
    <script src="/Styles/js/chart-data.js"></script>
    <script src="/Styles/js/easypiechart.js"></script>
    <script src="/Styles/js/easypiechart-data.js"></script>
    <script src="/Styles/js/bootstrap-datepicker.js"></script>
    <script src="/Styles/js/custom.js"></script>
    <script>
	    var startCharts = function () {
	                var chart1 = document.getElementById("line-chart").getContext("2d");
	                window.myLine = new Chart(chart1).Line(lineChartData, {
	                responsive: true,
	                scaleLineColor: "rgba(0,0,0,.2)",
	                scaleGridLineColor: "rgba(0,0,0,.05)",
	                scaleFontColor: "#c5c7cc "
	                });
	            }; 
	        window.setTimeout(startCharts(), 1000);
	</script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    
	</body>
</html>
