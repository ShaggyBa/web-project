<?php


include_once '../functions/connect.php';

if ($conn->error) {
	die("Connection failed: " . $conn->error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


	session_start();

	// Получаем значения из формы
	$reader_id = $_SESSION['user_id'];
	$reader_name = $_POST['reader_name'];
	$bookId = $_POST['book_id'];
	$date = date('Y-m-d');
	$collection_period = $_POST['collection_period'];
	$responsible_id = $_POST['responsible_id'];

	// Добавляем запись в таблицу
	$query = "INSERT INTO notes (reader_id, reader_name, book_id, date, collection_period, responsible_id) VALUES ('$reader_id', '$reader_name', '$bookId', '$date', '$collection_period', '$responsible_id')";

	if ($conn->query($query) === TRUE) {
		$query = "UPDATE books SET count = count - 1 WHERE id = '$bookId'";
		if ($conn->query($query) === TRUE) {
			$success_message = "note_added";
			$url = "..?" . http_build_query(['success_message' => $success_message]);
			header('Location: ' . $url);
		} else {
			$error_message = "book_update_error";
			$url = "../?" . http_build_query(['error_message' => $error_message]);
			header('Location: ' . $url);
		}
	} else {
		$error_message = "note_add_error";
		$url = "../?" . http_build_query(['error_message' => $error_message]);
		header('Location: ' . $url);
	}
} else {
	$error_message = "request_method_error";
	$url = "../?" . http_build_query(['error_message' => $error_message]);
	header('Location: ' . $url);
}
