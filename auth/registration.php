<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../styles/reset.css">
	<link rel="stylesheet" href="../styles/form.css">
	<link rel="stylesheet" href="../styles/auth_form.css">


	<title>Система библиотеки</title>
</head>

<body>
	<div class="wrapper">
		<div class="container">
			<form method="post" action="../functions/registrate.php">
				<?php
				if (isset($_GET['message']) && $_GET['message'] === 'user_exists') {
					echo '<p class="error">Данный пользователь уже существует!</p>';
				}
				?>
				<p class="form-title">Регистрация</p>
				<div class="form-field">
					<input id="name" type="text" name="name" pattern="[a-zA-Zа-яА-Я0-9]+" required>
					<label for="name" class="form-field__label">Ваше имя</label>
				</div>
				<div class="form-field">
					<input id="login" type="text" name="login" pattern="[a-zA-Z0-9]+" required>
					<label for="login" class="form-field__label">Ваш логин</label>
				</div>
				<div class="form-field">
					<input id="password" type="password" name="password" required>
					<label for="login" class="form-field__label">Пароль</label>
				</div>
				<div class="form-field">
					<input id="password" type="password" name="password" required>
					<label for="login" class="form-field__label">Повторите пароль</label>
				</div>
				<div class="form-field">
					<input type="checkbox" name="agreed" id="agreed" title="Для галочки" required>
					<label for="agreed">Я принимаю пользовательское соглашение</label>
				</div>
				<div class="form-field">
					<button type="submit">Зарегистрироваться</button>
				</div>
			</form>

			<p>Уже зарегистрированы? <a href="login.php">Войти</a></p>
		</div>
	</div>
</body>

</html>