<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../styles/reset.css">
	<link rel="stylesheet" href="../styles/form.css">

	<title>Система библиотеки</title>
</head>

<body>
	<div class="wrapper">
		<div class="container">
			<form method="post" action="../functions/log.php">
				<p class="form-title">Авторизация</p>
				<div class="form-field">
					<input id="name" type="text" name="name" pattern="[a-zA-Zа-яА-Я0-9]+" required>
					<label for="name" class="form-field__label">Ваше имя</label>
				</div>
				<div class="form-field">
					<input id="login" type="text" name="login" pattern="[a-zA-Z0-9]+" required>
					<label for="login" class="form-field__label">Логин</label>
				</div>
				<div class="form-field">
					<input id="password" type="password" name="password" required>
					<label for="login" class="form-field__label">Пароль</label>
				</div>
				<div class="form-field">
					<input type="checkbox" name="remember" id="remember">
					<label for="remember">Запомнить меня</label>
				</div>
				<div class="form-field">
					<button type="submit">Войти</button>
				</div>
			</form>

			<p>Нет аккаунта? <a href="registration.php">Зарегистрироваться</a></p>

			<?php
			if (isset($_GET['message']) && $_GET['message'] === 'success') {
				echo '<p class="success">Регистрация прошла успешно! Выполните вход.</p>';
			} else if (isset($_GET['message']) && $_GET['message'] === 'error') {
				echo '<p class="error">Ошибка авторизации. Попробуйте еще раз.</p>';
			}
			?>
		</div>
	</div>
</body>

</html>