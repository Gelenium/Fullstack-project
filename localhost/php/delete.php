<?php
	require_once '../config/connect.php';
	$student_id = $_GET['id'];
	mysqli_query($connect, "DELETE FROM `s_t` WHERE `s_t`.`id_student` = $student_id");
	mysqli_query($connect, "DELETE FROM `students` WHERE `students`.`id_student` = $student_id");	
	require_once '../config/help.php';
	header('Location: http://localhost/groups.php');
?>