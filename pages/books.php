<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../styles/reset.css">
	<link rel="stylesheet" href="../styles/main.css">
	<link rel="stylesheet" href="../styles/books_page.css">
	<link rel="stylesheet" href="../styles/modal.css">
	<link rel="stylesheet" href="../styles/form.css">
	<title>Система библиотеки</title>
</head>

<body>
	<?php
	include "../functions/connect.php";
	session_start();

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if (!isset($_SESSION['user'])) {
		header('Location: auth/login.php');
		exit;
	}

	if ($_SESSION['role'] !== 'administrator' && $_SESSION['role'] !== 'librarian') {
		header('Location: ../index.php');
		exit;
	}

	$query = "SELECT * FROM books";
	$result = $conn->query($query);

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
			<div class="books__menu">
				<ul>
					<li><a href="./books/books_edit.php">Управление книгами</a></li>
					<li><a href="./books/add_book.php">Быстрое добавление книги</a></li>
				</ul>
			</div>
			<main>
				<section>
					<h2 class="title">Наша библиотека</h2>
					<div class="books">
						<?php while ($row = $result->fetch_assoc()) : ?>
							<div class="book" data-book-id="<?php echo $row['id']; ?>">
								<img class="book__image" src="<?php echo $row['image']; ?>" />
								<p class="book__title"><?php echo $row['book_name']; ?> </p>
								<p class="book__author"><?php echo $row['author']; ?></p>
								<p class="book__count"><?php echo $row['count']; ?> шт. </p>
								<button onclick="openModal('<?php echo $row['id']; ?>', '<?php echo $_SESSION['user']; ?>')">
									Арендовать</button>

								<!-- <?php if ($_SESSION['role'] === 'reader') : ?>
									<button onclick="location.href='pages/book.php?id=<?php echo $row['id']; ?>">Арендовать</button>
								<?php endif; ?> -->
							</div>
						<?php endwhile; ?>
					</div>
				</section>
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
		<!-- Модальное окно -->
		<div id="modal" class="modal">
			<div class="modal-content">
				<span class="close" onclick="closeModal()">&times;</span>
				<h2 class="title">Аренда книги</h2>
				<form id="rentForm" action="../api/add_note.php">
					<div class="form-field">
						<textarea id="bookInfo" readonly></textarea>
						<label for="bookInfo" class="form-field__label">Сведения о книге:</label>
					</div>
					<div class="form-field">
						<input type="text" id="name" readonly>
						<label for="name" class="form-field__label">Имя:</label>
					</div>
					<div class="form-field">
						<input type="text" id="rentDate" pattern="\d{2}.\d{2}.\d{4}" required>
						<label for="rentDate" class="form-field__label">Дата аренды:</label>

					</div>
					<div class="form-field">
						<input type="number" id="rentDuration" min="1" max="60" required>
						<label for="rentDuration" class="form-field__label">Срок аренды (в днях):</label>

					</div>
					<div class="form-field">
						<select id="librarian" required>
							<option value="">Выберите библиотекаря</option>
							<!-- Здесь можно динамически добавить варианты из пользователей с ролью библиотекаря -->
						</select>
						<label for="librarian" class="form-field__label">Библиотекарь:</label>

					</div>
					<button type="submit">Арендовать</button>
				</form>
			</div>
		</div>
		<script src="../scripts/books.js"></script>
</body>

</html>