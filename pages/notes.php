<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../styles/reset.css">
	<link rel="stylesheet" href="../styles/main.css">
	<link rel="stylesheet" href="../styles/table.css">
	<link rel="stylesheet" href="../styles/notes_page.css">
	<title>Система библиотеки</title>
</head>

<body>
	<?php
	session_start();

	if (!isset($_SESSION['user'])) {
		header('Location: auth/login.php');
		exit;
	}

	if ($_SESSION['role'] !== 'administrator' && $_SESSION['role'] !== 'librarian') {
		header('Location: ../index.php');
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
			<main class="notes">
				<h2 class="title">Записи библиотеки</h2>

				<table class="table">
					<thead>
						<tr>

							<th>ID</th>
							<th>ID читателя</th>
							<th>Имя читателя</th>
							<th>ID книги</th>
							<th>Дата</th>
							<th>Период взятия</th>
							<th>Ответственное лицо</th>

						</tr>
					</thead>
					<tbody>
						<?php
						include_once '../functions/connect.php';

						$query = "SELECT * FROM notes";

						foreach ($conn->query($query) as $row) {

							echo "<tr>";
							echo "<td>" . $row['id'] . "</td>";
							echo "<td>" . $row['reader_id'] . "</td>";
							echo "<td>" . $row['reader_name'] . "</td>";
							echo "<td>" . $row['book_id'] . "</td>";
							echo "<td>" . $row['date'] . "</td>";
							echo "<td>" . $row['collection_period'] . "</td>";
							echo "<td>" . $row['responsible_id'] . "</td>";
							echo "</tr>";
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
</body>

</html>