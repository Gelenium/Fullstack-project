<?php
	require_once '../config/connect.php';
	$student_id = $_GET['id'];
	$group_id = $_GET['grup'];
	$student_name = mysqli_query($connect, "SELECT * FROM `students` WHERE `id_student` = $student_id");
	$student_name = mysqli_fetch_assoc($student_name);
	$student_name = $student_name['name'];
	$numbers = mysqli_query($connect, "SELECT * FROM `s_t` WHERE `id_student` = $student_id ORDER BY `id_task`");
	$numbers = mysqli_fetch_all($numbers);
	setcookie('student_id', $student_id, time() + 3600 * 2, "/");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Обновить данные</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
	<div class="position-absolute top-50 start-50 translate-middle">
		<table class="table" width="100%">
			<tr>
				<th>Имя студента</th>
				<?php				
					foreach($numbers as $item) {
						$task = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `id_task` = $item[2] ORDER BY `number`");
						$task = mysqli_fetch_assoc($task);
						?>
				<th>№<?=$task['number']?></th>
				<?php
					}
						?>
			</tr>
			<tr>
				<td><?=$student_name?></td>
				<form action="update2.php" method="$_POST">
					<?php	foreach($numbers as $item) {?>
					<td><input type="text" class="form-control" name="<?= $item[2]?>" id="login"
							value="<?php if($item[3]=="0") echo "-"; else echo "+"?>"></td>
					<?php }?>
					<td><button class="btn btn-outline-secondary" type="submit">Подтвердить изменения</button></td>
				</form>
			</tr>
		</table>
	</div>
</body>

</html>