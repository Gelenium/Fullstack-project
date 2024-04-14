<?php
	$connect = mysqli_connect('localhost', 'root', '', 'diplom');
	if(!$connect) {
		die('Ошибка подключения к БД');
	}
?>