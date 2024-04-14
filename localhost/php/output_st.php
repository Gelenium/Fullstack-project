<?php
	require_once '../config/connect.php';
	$student_id = $_GET['wow'];
	$student_name = mysqli_query($connect, "SELECT * FROM `students` WHERE `id_student` = $student_id");
	$student_name = mysqli_fetch_assoc($student_name);
	$group = $student_name['id_group'];
	$student_name = $student_name['name'];
	$numbers = mysqli_query($connect, "SELECT * FROM `s_t` WHERE `id_student` = $student_id ORDER BY `s_t`.`id_task` ASC");
	$cols = mysqli_num_rows($numbers);
	$numbers = mysqli_fetch_all($numbers);	
	$tasks = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `id_group` = $group ORDER BY `tasks`.`number` ASC");
	$tasks = mysqli_fetch_all($tasks);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Успеваемость</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
	<form action="exit.php" class="text-end">
		<p>Привет, <?=$_COOKIE['user']?>.</p>
		<button class="btn btn-outline-secondary ">Пока ( ͡° ͜ʖ ͡°)</button>
	</form>
	<div class="container position-absolute top-50 start-50 translate-middle">
		<h2 class="mb-3 text-center">Мои данные</h2><br>

		<table class="table table-hover table-bordered mt-5">
			<tr>
				<th>Имя студента</th>
				<?php				
					foreach($numbers as $item) {
						$task = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `id_task` = $item[2] ORDER BY `tasks`.`number` ASC");
						$task = mysqli_fetch_assoc($task);
						?>
				<th>№<?=$task['number']?></th>
				<?php
					}
						?>
				<th>Выполнено</th>
			</tr>
			<tr>
				<td><?=$student_name?></td>
				<?php
					$percent = 0;
					foreach($tasks as $item2) {
						$done_li = mysqli_query($connect, "SELECT * FROM `s_t` WHERE `id_student` = $student_id AND `id_task` = $item2[0]");
						$done_li = mysqli_fetch_assoc($done_li);
						$done_li = $done_li['done_or_no'];
						if($done_li == '0') {
							$done_li = '-';
						}
						else {
							$done_li = "+";
							$percent = $percent + 1;
								}
								?>
				<td><?=$done_li?></td>
				<?php	
							}
							$percent = round($percent / $cols * 100, 2);
						?>
				<td><?=$percent?>%</td>
			</tr>
		</table>

	</div>
</body>

</html>