<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Система библиотеки</title>
</head>

<body>
	<div class="container">
		<h1>Система библиотеки</h1>
		<?php
		session_start();

		if (!isset($_SESSION['user'])) {
			header('Location: auth/login.php');
			exit;
		} else {
			echo '<p>Вы вошли как ' . $_SESSION['user'] . ' (' . $_SESSION['role'] . ')</p>
			. <button onclick="location.href=\'auth/logout.php\'">Выйти</button>';
		}
		?>
	</div>
</body>

</html>