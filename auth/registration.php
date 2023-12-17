<form method="post" action="../functions/registrate.php">
	<p>Авторизация</p>
	<?php
	if (isset($_GET['message']) && $_GET['message'] === 'user_exists') {
		echo '<p>Данный пользователь уже существует!</p>';
	}
	?>
	<div class="form-field">
		<input id="name" type="text" name="name" placeholder="Имя" required pattern="[a-zA-Zа-яА-Я0-9]+">
		<label for="name" class="">Ваше имя</label>
	</div>
	<div class="form-field">
		<input id="login" type="text" name="login" placeholder="Логин" required pattern="[a-zA-Z0-9]+">
		<label for="login" class="">Ваш логин</label>
	</div>
	<div class="form-field">
		<input id="password" type="password" name="password" placeholder="Пароль" required>
		<label for="login" class="">Пароль</label>
	</div>
	<div class="form-field">
		<input id="password" type="password" name="password" placeholder="Повторите пароль" required>
		<label for="login" class="">Повторите пароль</label>
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