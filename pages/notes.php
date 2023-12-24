<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../styles/reset.css">
	<link rel="stylesheet" href="../styles/main.css">
	<title>Система библиотеки</title>
</head>

<body>
	<?php
	session_start();

	if (!isset($_SESSION['user'])) {
		header('Location: auth/login.php');
		exit;
	}
	?>
	<div class="wrapper">
		<header>
			<nav>
				<ul>
					<li><a href="../index.php">Главная</a></li>
					<li><a href="books.php">Список книг</a></li>
					<?php if ($_SESSION['role'] === 'librarian' || $_SESSION['role'] === 'administrator') : ?>
						<li><a href="notes.php">Записи</a></li>
					<?php endif; ?>
					<?php if ($_SESSION['role'] === 'administrator') : ?>
						<li><a href="users.php">Пользователи</a></li>
					<?php endif; ?>
				</ul>
			</nav>
			<div class="user-info">
				<p><?php echo $_SESSION['user']; ?>
					(<?php
						if ($_SESSION['role'] === 'librarian') {
							echo 'Библиотекарь';
						} elseif ($_SESSION['role'] === 'administrator') {
							echo 'Администратор';
						} else {
							echo 'Читатель';
						}
						?>)
				</p>
				<button onclick="location.href='../functions/logout.php'">Выйти</button>
			</div>
		</header>
		<div class="container">
			<main>
				<!-- Ваша основная контентная часть -->
			</main>
		</div>
		<footer>
			<nav>
				<ul>
					<li><a href="../index.php">Главная</a></li>
					<li><a href="books.php">Список книг</a></li>
					<?php if ($_SESSION['role'] === 'librarian' || $_SESSION['role'] === 'administrator') : ?>
						<li><a href="notes.php">Записи</a></li>
					<?php endif; ?>
					<?php if ($_SESSION['role'] === 'administrator') : ?>
						<li><a href="users.php">Пользователи</a></li>
					<?php endif; ?>
				</ul>
			</nav>
		</footer>
	</div>
</body>

</html>