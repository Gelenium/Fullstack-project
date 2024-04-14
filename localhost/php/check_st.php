<?php
	require_once '../config/connect.php';
	$name = filter_var(trim($_POST['login']), 
	FILTER_SANITIZE_STRING);
	$pass = filter_var(trim($_POST['pass']), 
	FILTER_SANITIZE_STRING);
	$user = mysqli_query($connect, "SELECT * FROM `students` WHERE `name` = '$name' AND `pass` = '$pass'");
	$num_rows = mysqli_num_rows($user);
	$user = mysqli_fetch_assoc($user);
	$buf = $user['id_student'];
	if($num_rows == 0) {
		echo "Такой студент не найден";
		exit();
	}
	setcookie('user', $user['name'], time() + 3600 * 2, "/");
	setcookie('user_id', $user['id'], time() + 3600 * 2, "/");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Вход</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
	<p class="text-center container position-absolute top-50 start-50 translate-middle">Если ты и сам всё знаешь, то <a
			href="exit.php">на выход</a>. Если всё же надо глянуть, то жми <a href="output_st.php?wow=<?=$buf?>">сюда</a>.</p>
</body>

</html>