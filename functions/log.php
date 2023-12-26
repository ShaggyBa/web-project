<?php
require_once 'connect.php'; ?>

<?php
if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['name'])) {

	$name = $_POST['name'];
	$login = $_POST['login'];
	$password = $_POST['password'];

	$query = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password' AND `name` = '$name'";

	$result = mysqli_query($conn, $query);

	if ($result && mysqli_num_rows($result) > 0) {
		session_start();

		$row = mysqli_fetch_assoc($result);
		$role = $row['role'];
		$user_id = $row['id'];
		$_SESSION['user'] = $name;
		$_SESSION['role'] = $role;
		$_SESSION['user_id'] = $user_id;

		header('Location: ../index.php?id=' . $user_id . '&role=' . $role);

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
