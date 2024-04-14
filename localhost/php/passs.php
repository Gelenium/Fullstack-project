<?php
	require_once '../config/connect.php';
	$group = $_GET['gr'];
	$students = mysqli_query($connect, "SELECT * FROM `students` WHERE `id_group` = $group ORDER BY `students`.`name` ASC");
	$num_rows = mysqli_num_rows($students);
	$students = mysqli_fetch_all($students);	
	require_once '../config/help.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Пароли</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
	<div class="container position-absolute top-50 start-50 translate-middle">
		<table class="table table-hover table-bordered mt-5">
			<tr>
				<th>Имя студента</th>
				<th>Пароль</th>
			</tr>
			<!-- <tr> -->
			<?php foreach($students as $item) {?>
			<tr>
				<td><?=$item[2]?></td>
				<td><?=$item[3]?></td>
			</tr>
			<?php } ?>
			<!-- </tr> -->
		</table>
	</div>
</body>

</html>

<!-- <?php
	require_once '../config/help.php';
?> -->