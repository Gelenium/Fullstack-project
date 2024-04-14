<?php
	setcookie('update', 1, time() + 3600 * 2, "/");
	if($_COOKIE['group'] != '') {
		$x = $_COOKIE['group'];
		setcookie('buf', $x, time() + 3600 * 2, "/");
	}
?>