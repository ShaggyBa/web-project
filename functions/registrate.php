<?php
require_once 'connect.php'; ?>

<?php
if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['name'])) {

	$name = $_POST['name'];
	$login = $_POST['login'];
	$password = $_POST['password'];

	$query = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'";

	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) === 0) {
		$query = "INSERT INTO `users` (`name`, `login`, `password`, `role`) VALUES ('$name', '$login', '$password', 'reader')";
		$result = mysqli_query($conn, $query);

		if ($result) {
			header('Location: ../auth/login.php?message=success');
			$conn->close();
			exit;
		} else {
			header('Location: ../auth/registration.php');
			$conn->close();
			exit;
		}
	} else {
		header('Location: ../auth/registration.php?message=user_exists');
		$conn->close();
		exit;
	}
} else {
	header('Location: ../auth/registration.php');
	$conn->close();
	exit;
}
