<?php
	require_once '../config/connect.php';
	$new_gr = $_POST['year_n_days'];
	$don = $_COOKIE['user_id'];
	mysqli_query($connect, "INSERT INTO `groups` (`id`, `year_n_days`, `don`) VALUES (NULL, '$new_gr', '$don')");
	header('Location: http://localhost/groups.php');
?>