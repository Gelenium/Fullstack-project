<?php
	require_once '../config/connect.php';
	require_once '../config/help.php';
	$new_st = $_POST['name'];
	$new_pass = $_POST['pass'];
	if($_COOKIE['group'] == '')	$buf = $_COOKIE['buf']; else $buf = $_COOKIE['group'];
	mysqli_query($connect, "INSERT INTO `students` (`id_student`, `id_group`, `name`, `pass`) VALUES (NULL, '$buf', '$new_st', '$new_pass')");
	header('Location: http://localhost/groups.php');
?>