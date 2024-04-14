<?php
	$don_id = $_COOKIE['user_id'];
	require_once 'config/connect.php';
	$groups = mysqli_query($connect, "SELECT * FROM `groups` WHERE `don` = $don_id");
	$groups = mysqli_fetch_all($groups);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Список групп</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
	<form action="php/exit.php" class="text-end">
		<p>Здравствуйте, <?=$_COOKIE['user']?>!</p>
		<button class="btn btn-outline-secondary ">До свидания ( ͡° ͜ʖ ͡°)</button>
	</form>

	<div class="container">
		<div class="row g-25 text-center"> <br>
			<h2 class="mb-3">Мои группы</h2><br>
			<form action="" method="POST">
				<div class="form-group">
					<select name="don" class="form-select">
						<option selected>Выберите группу</option>
						<?php
								foreach($groups as $item) {
									echo '
									<option value ="'.$item[0].'">'.$item[1].'</option>	
									';
								}
							?>
					</select><br>
				</div>
				<button class="btn btn-outline-secondary" type="submit">Подтвердить</button><br>
			</form><br>
			<div class="col">
				<h4 class="mb-3 mt-3">Добавить группу</h4><br>
				<form action="php/new_group.php" method="POST">
					<input type="text" class="form-control" name="year_n_days" id="login"
						placeholder="Введите данные группы в формате *год обучения* Курс, *дни проведения занятий*"><br>
					<button class="btn btn-outline-success" type="submit">Добавить</button>
				</form>
			</div>
			<div class="col">
				<h4 class="mb-3 mt-3">Добавить студента</h4><br>
				<form action="php/new_student.php" method="POST">
					<div class="row g-25 text-center">

						<input type="text" class="form-control col" name="name" id="login" placeholder="Введите фамилию и имя"> <br>
						<input type="password" class="form-control col" name="pass" id="pass" placeholder="Введите пароль"><br>
					</div><br>
					<button class="btn btn-outline-success" type="submit">Добавить</button>
				</form>
			</div>
		</div>
		<?php
			$group = $_POST['don'];
			if($group =="Выберите группу") {
				echo "Группа не выбрана!";
				exit;					
			}		
					setcookie('group', $group, time() + 3600 * 2, "/");
					if($_COOKIE['update'] != '') {$group = $_COOKIE['buf'];}
					setcookie('update', null, time() - 3600 * 2, "/");
					if($group != null): 
					$tasks = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `id_group` = $group ORDER BY `number`");
					$cols = mysqli_num_rows($tasks);
					$tasks = mysqli_fetch_all($tasks);
					$students = mysqli_query($connect, "SELECT * FROM `students` WHERE `id_group` = $group ORDER BY `name`");							
					$students = mysqli_fetch_all($students);
					foreach($students as $item) {
						foreach($tasks as $item2) {
							$s_t = mysqli_query($connect, "SELECT * FROM `s_t` WHERE `id_student` = $item[0] AND `id_task` = $item2[0]");
							$num_rows = mysqli_num_rows($s_t);
							if($num_rows == 0) {
								mysqli_query($connect, "INSERT INTO `s_t` (`id`, `id_student`, `id_task`, `done_or_no`) VALUES (NULL, '$item[0]', '$item2[0]', '0')");
							}
						}
					}
				?>
		<table class="table table-hover table-bordered mt-5">
			<tr>
				<th rowspan="2" class="text-center">Студенты группы</th>
				<th colspan="<?=$cols?>" class="text-center">Номера заданий</th>
				<th class="text-center" style="border-bottom:hidden">Выполнено</th>
				<th colspan="2" rowspan="2" class="text-center">Редактирование</th>
			</tr>
			<tr>
				<?php							
								foreach($tasks as $item) {
									?>
				<th>№<?=$item[1]?></th>
				<?php
								}
							?>
				<th colspan="2"></th>
			</tr>
			<?php							
							foreach($students as $item) {
							  $percent = 0;
						?>
			<tr>
				<td><?=$item[2]?></td>
				<?php
										// $percent = 
										foreach($tasks as $item2) {
											$done_li = mysqli_query($connect, "SELECT * FROM `s_t` WHERE `id_student` = $item[0] AND `id_task` = $item2[0]");
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
										if($percent != 0) $percent = round($percent / $cols * 100, 2);
									?>
				<td><?=$percent?>%</td>
				<td class="text-center" style="border-right:hidden"><a class="btn btn-outline-success"
						href="php/update.php?id=<?= $item[0]?>&grup=<?=$group?>">&#9998;</a></td>
				<td class="text-center" style="border-left:hidden"><a class="btn btn-outline-danger"
						onclick="return confirm('Вы уверены, что хотите удалить <?=$item[2]?>?')"
						href="php/delete.php?id=<?= $item[0]?>">&#10006;</a></td>
			</tr>
			<?php			
							}
							?>
		</table>
		<form action="php/new_task.php" class="text-center">
			<input type="text" class="mt-5 form-control" name="number" id="login" placeholder="Номер задания"><br>
			<button class="col btn btn-outline-success">Добавить задание</button>
		</form> <br><br><br>
		<div class="text-end">
			<a class="btn btn-outline-secondary" target="_blank" href="php/passs.php?gr=<?= $group?>">Пароли
				студентов</a><br><br>
		</div>

		<?php endif;?>
	</div>
</body>

</html>