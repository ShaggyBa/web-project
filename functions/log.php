<?php
require_once 'connect.php'; ?>

<?php
if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['name'])) {

	$name = $_POST['name'];
	$login = $_POST['login'];
	$password = $_POST['password'];

	$query = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password' AND `name` = '$name'";

	$result = mysqli_query($conn, $query);


	if ($result) {
		session_start();

		$role = mysqli_fetch_assoc($result)['role'];

		$_SESSION['user'] = $name;
		$_SESSION['role'] = $role;
		header('Location: ../index.php');
		$conn->close();
		exit;
	} else {
		header('Location: ../auth/login.php?message=error');
		$conn->close();
		exit;
	}
} else {
	header('Location: ../auth/login.php?message=error');
	$conn->close();
	exit;
}
