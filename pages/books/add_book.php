<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../../styles/reset.css">
	<link rel="stylesheet" href="../../styles/main.css">
	<link rel="stylesheet" href="../../styles/form.css">
	<title>Система библиотеки - Добавление книги</title>
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
					<li><a href="../../index.php">Главная</a></li>
					<li><a href="../books.php">Список книг</a></li>
					<?php if ($_SESSION['role'] === 'librarian' || $_SESSION['role'] === 'administrator') : ?>
						<li><a href="../notes.php">Записи</a></li>
					<?php endif; ?>
					<?php if ($_SESSION['role'] === 'administrator') : ?>
						<li><a href="../users.php">Пользователи</a></li>
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
				<button onclick="location.href='../../functions/logout.php'">Выйти</button>
			</div>
		</header>
		<div class="container">
			<main>
				<h2 class="title">Добавление книги</h2>
				<form action="../../api/add_book.php" method="POST" enctype="multipart/form-data">
					<div class="form-field">
						<input type="text" id="book_name" name="book_name" required>
						<label class="form-field__label" for="book_name">Название:</label>

					</div>
					<div class="form-field">
						<input type="text" id="author" name="author" required>
						<label class="form-field__label" for="author">Автор:</label>
					</div>
					<div class="form-field">
						<input type="number" id="count" name="count" min="1" max="1000" required>
						<label class="form-field__label" for="count">Количество:</label>
					</div>
					<div class="form-field">
						<input type="url" id="image" name="image" required>
						<label class="form-field__label" for="image">Ссылка на изображение:</label>
					</div>
					<button type="submit">Добавить книгу</button>
				</form>
			</main>
		</div>
		<footer>
			<nav>
				<ul>
					<li><a href="../../index.php">Главная</a></li>
					<li><a href="../books.php">Список книг</a></li>
					<?php if ($_SESSION['role'] === 'librarian' || $_SESSION['role'] === 'administrator') : ?>
						<li><a href="../notes.php">Записи</a></li>
					<?php endif; ?>
					<?php if ($_SESSION['role'] === 'administrator') : ?>
						<li><a href="../users.php">Пользователи</a></li>
					<?php endif; ?>
				</ul>
			</nav>
		</footer>
	</div>
</body>

</html>