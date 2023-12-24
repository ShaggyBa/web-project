<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="./styles/reset.css">
	<link rel="stylesheet" href="./styles/main.css">
	<title>Система библиотеки</title>
</head>

<body>
	<?php
	include "./functions/connect.php";

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	session_start();

	if (!isset($_SESSION['user'])) {
		header('Location: auth/login.php');
		exit;
	}

	$query = "SELECT * FROM books ORDER BY id DESC LIMIT 5";
	$result = $conn->query($query);

	?>
	<div class="wrapper">
		<header>
			<nav>
				<ul>
					<li><a href="index.php">Главная</a></li>
					<li><a href="pages/books.php">Список книг</a></li>
					<?php if ($_SESSION['role'] === 'librarian' || $_SESSION['role'] === 'administrator') : ?>
						<li><a href="pages/notes.php">Записи</a></li>
					<?php endif; ?>
					<?php if ($_SESSION['role'] === 'administrator') : ?>
						<li><a href="pages/users.php">Пользователи</a></li>
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
				<button onclick="location.href='functions/logout.php'">Выйти</button>
			</div>
		</header>
		<div class="container">
			<main>
				<!-- Секция с последними добавленными книгами -->
				<section>
					<h2 class="title">Последние пополнения библиотеки</h2>
					<div class="books">
						<?php while ($row = $result->fetch_assoc()) : ?>
							<div class="book">
								<img class="book__image" src="<?php echo $row['image']; ?>" />
								<p class="book__title"><?php echo $row['book_name']; ?> </p>
								<p class="book__author"><?php echo $row['author']; ?></p>
								<p class="book__count"><?php echo $row['count']; ?> шт. </p>
								<button onclick="location.href='pages/book.php?id=<?php echo $row['id']; ?>">Арендовать</button>

							</div>
						<?php endwhile; ?>
					</div>
				</section>
			</main>
		</div>
		<footer>
			<nav>
				<ul>
					<li><a href=" index.php">Главная</a></li>
					<li><a href="pages/books.php">Список книг</a></li>
					<?php if ($_SESSION['role'] === 'librarian' || $_SESSION['role'] === 'administrator') : ?>
						<li><a href="pages/notes.php">Записи</a></li>
					<?php endif; ?>
					<?php if ($_SESSION['role'] === 'administrator') : ?>
						<li><a href="pages/users.php">Пользователи</a></li>
					<?php endif; ?>
				</ul>
			</nav>
		</footer>
	</div>
</body>

</html>