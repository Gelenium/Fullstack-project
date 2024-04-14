<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Форма авторизации</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="container position-absolute top-50 start-50 translate-middle row">
		<?php
			if($_COOKIE['user'] == ''): 
		?>
		<div class="col">
			<h1>Авторизация преподавателя</h1> <br>
			<form action="php/check.php" method="post">
				<input type="text" class="form-control" name="login" id="login" placeholder="Введите логин"><br>
				<input type="password" class="form-control" name="pass" id="pass" placeholder="Введите пароль"><br>
				<button class="btn btn-outline-secondary" type="submit">Войти</button>
			</form>
		</div>

		<div class="col">
			<h1>Авторизация студента</h1> <br>
			<form action="php/check_st.php" method="post">
				<input type="text" class="form-control" name="login" id="login" placeholder="Введите ФИО"><br>
				<input type="password" class="form-control" name="pass" id="pass" placeholder="Введите пароль"><br>
				<button class="btn btn-outline-secondary" type="submit">Войти</button>
			</form>
		</div>
	</div>
	<?php else: ?>
	<p class="text-center">А может, ну их, этих студентов? А, <?=$_COOKIE['user']?>? Если согласны, нажмите <a
			href="php/exit.php">здесь</a>. Если Феде всё-таки надо, то
		<?php setcookie('group', $group, time() - 3600 * 2, "/"); setcookie('buf', null, time() - 3600 * 2, "/"); setcookie('update', null, time() - 3600 * 2, "/");?>
		<a href="groups.php">здесь</a>.
	</p>
	<?php endif;?>

</body>

</html>