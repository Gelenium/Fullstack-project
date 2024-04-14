<?php
	$login = filter_var(trim($_POST['login']), 
	FILTER_SANITIZE_STRING);
	$pass = filter_var(trim($_POST['pass']), 
	FILTER_SANITIZE_STRING);
	$mysql = new mysqli('localhost', 'root', '', 'diplom');
	$result = $mysql -> query("SELECT * FROM `dons` WHERE `login` = '$login' AND `pass` = '$pass'");
	$num_rows = mysqli_num_rows($result);
	$user = $result -> fetch_assoc();
	if($num_rows == 0) {
		echo "Такой пользователь не найден";
		exit();
	}
	setcookie('user', $user['name'], time() + 3600 * 2, "/");
	setcookie('user_id', $user['id'], time() + 3600 * 2, "/");
	header('Location: http://localhost/autorization.php');
?>