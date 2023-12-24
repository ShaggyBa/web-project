<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../styles/reset.css">
	<link rel="stylesheet" href="../styles/main.css">
	<link rel="stylesheet" href="../styles/users.css">
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
			<main class="users">
				<p class="users__title">Список пользователей</p>

				<table class="users__table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Имя</th>
							<th>Роль</th>
							<th>Действия</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include_once '../functions/connect.php';

						$query = "SELECT id, name, role FROM users WHERE role != 'administrator'";

						foreach ($conn->query($query) as $row) {
							echo '<tr class="users__row" data-id="' . $row['id'] . '">';
							echo '<td>' . $row['id'] . '</td>';
							echo '<td>' . $row['name'] . '</td>';
							echo '<td class="role__value">';
							// Вывод текущей роли пользователя
							if ($row['role'] === 'librarian') {
								echo '<span>Библиотекарь</span>';
							} elseif ($row['role'] === 'reader') {
								echo '<span>Читатель</span>';
							}
							// Добавление элемента управления для редактирования роли (например, выпадающий список)
							echo '<select name="role" class="role__select">';
							echo '<option value="librarian">Библиотекарь</option>';
							echo '<option value="reader">Читатель</option>';
							echo '</select>';
							echo '</td>';
							echo '<td>';
							// Добавление кнопки для сохранения изменений роли
							echo '<button onclick="updateUserRole(this)" class="save__button">Сохранить</button>';
							echo '</td>';
							echo '</tr>';
						}
						?>
					</tbody>
				</table>
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

	<script src="../scripts/users.js"></script>
</body>

</html>