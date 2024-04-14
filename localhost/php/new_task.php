<?php
	require_once '../config/connect.php';
	require_once '../config/help.php';
	$task_name = $_GET['number'];
	if($_COOKIE['group'] == '')	$buf = $_COOKIE['buf']; else $buf = $_COOKIE['group'];
	mysqli_query($connect, "INSERT INTO `tasks` (`id_task`, `number`, `id_group`) VALUES (NULL, '$task_name', '$buf')");
	header('Location: http://localhost/groups.php');
?>