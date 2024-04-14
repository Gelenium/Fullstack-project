<?php
	$name = filter_var(trim($_POST['name']), 
	FILTER_SANITIZE_STRING);
	$login = filter_var(trim($_POST['login']), 
	FILTER_SANITIZE_STRING);
	$pass = filter_var(trim($_POST['password']), 
	FILTER_SANITIZE_STRING);
	if(mb_strlen($login) < 5 || mb_strlen($login) > 15) {
		echo "Недопустимая длина логина";
		exit();
	} else if(mb_strlen($name) < 4 || mb_strlen($name) > 50) {
		echo "Недопустимая длина имени";
		exit();
	} else if(mb_strlen($pass) < 4 || mb_strlen($pass) > 30) {
		echo "Недопустимая длина пароля (от 8 до 30 символов)";
		exit();
	} 
	$mysql = new mysqli('localhost', 'root', '', 'diplom');
	$mysql -> query("INSERT INTO `dons` (`login`, `pass`, `name`) 
	VALUES('$login', '$pass', '$name') ");
	$mysql->close();
	header('Location: http://localhost/autorization.php');
?>