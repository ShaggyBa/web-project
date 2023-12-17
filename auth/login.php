<form method="post" action="../functions/log.php">
	<p>Авторизация</p>
	<div class="form-field">
		<input id="name" type="text" name="name" placeholder="Имя" required pattern="[a-zA-Zа-яА-Я0-9]+">
		<label for="name" class="">Ваше имя</label>
	</div>
	<div class="form-field">
		<input id="login" type="text" name="login" placeholder="Логин" pattern="[a-zA-Z0-9]+">
		<label for="login" class="">Логин</label>
	</div>
	<div class="form-field">
		<input id="password" type="password" name="password" placeholder="Пароль">
		<label for="login" class="">Пароль</label>
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
	echo '<p>Регистрация прошла успешно! Выполните вход.</p>';
} else if (isset($_GET['message']) && $_GET['message'] === 'error') {
	echo '<p>Ошибка авторизации. Попробуйте еще раз.</p>';
}
