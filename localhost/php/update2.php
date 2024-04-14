<?php
	require_once '../config/connect.php';
	$count_num = array();
	$student_id = $_COOKIE['student_id'];
	$numbers = mysqli_query($connect, "SELECT * FROM `s_t` WHERE `id_student` = $student_id ORDER BY `id_task`");
	$numbers = mysqli_fetch_all($numbers);
	foreach($numbers as $item) {
		$count_num[$item[2]] = $_GET[$item[2]];
	}
	foreach ($numbers as $item) {
		if($count_num[$item[2]] == '-') $buf = 0; else $buf = 1;		
  	mysqli_query($connect, "UPDATE `s_t` SET `done_or_no` = $buf WHERE `s_t`.`id_task` = $item[2] AND `s_t`.`id_student` = $student_id");
	}
	require_once '../config/help.php';
	header('Location: http://localhost/groups.php');
?>