<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../../styles/reset.css">
	<link rel="stylesheet" href="../../styles/main.css">
	<link rel="stylesheet" href="../../styles/books_page.css">
	<link rel="stylesheet" href="../../styles/books_edit.css">
	<link rel="stylesheet" href="../../styles/table.css">
	<link rel="stylesheet" href="../../styles/modal.css">
	<title>Система библиотеки - Добавление книги</title>
</head>

<body>
	<?php
	session_start();

	if (!isset($_SESSION['user'])) {
		header('Location: auth/login.php');
		exit;
	}

	if ($_SESSION['role'] !== 'administrator' && $_SESSION['role'] !== 'librarian') {
		header('Location: ../../index.php');
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
			<div class="books__menu">
				<ul>
					<li><a href="./books_edit.php">Управление книгами</a></li>
					<li><a href="./add_book.php">Быстрое добавление книги</a></li>
				</ul>
			</div>
			<main class="books__edit">
				<h2 class="title">Управление книгами</h2>
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Название книги</th>
							<th>Автор</th>
							<th>Количество</th>
							<th>Изображение</th>
							<th>Действия</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include_once '../../functions/connect.php';

						$query = "SELECT * FROM books";

						foreach ($conn->query($query) as $row) {
							echo '<tr class="table__row" data-id="' . $row['id'] . '">';
							echo '<td>' . $row['id'] . '</td>';
							echo '<td data-edit=true>' . $row['book_name'] . '</td>';
							echo '<td data-edit=true>' . $row['author'] . '</td>';
							echo '<td data-edit=true>' . $row['count'] . '</td>';
							echo '<td data-edit=true>' . $row['image'] . '</td>';
							echo '<td class="table__actions">';

							echo '<button onclick="editBook(this)">Изменить</button>';

							echo '<button onclick="onDeleteBook(this)">Удалить</button>';
							echo '</td>';
							echo '</tr>';
						}
						?>
						<tr class="table__row">
							<td></td>
							<td><input class="book__name--input" type="text" name="book_name" placeholder="Название книги"></td>
							<td><input class="book__author--input" type="text" name="author" placeholder="Автор"></td>
							<td><input class="book__count--input" type="number" name="count" placeholder="Количество"></td>
							<td><input class="book__image--input" type="text" name="image" placeholder="Ссылка на изображение"></td>
							<td><button onclick="addBook(this)">Добавить</button></td>
						</tr>
					</tbody>
				</table>

			</main>
		</div>
		<!-- Модальное окно подтверждения удаления записи -->
		<div id="deleteModal" class="modal">
			<div class="modal-content">
				<span class="close">&times;</span>
				<h2 class="title">Подтверждение удаления</h2>
				<p>Вы действительно хотите удалить эту книгу?</p>
				<button id="confirmDeleteBtn">Удалить</button>
			</div>
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
	<script src="../../scripts/books_edit.js"></script>
</body>

</html>