<?php
include_once "../functions/connect.php";

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$jsonData = file_get_contents('php://input');
	// Decode the JSON data into a PHP associative array
	$data = json_decode($jsonData, true);

	if ($data === null) {
		//POST запрос с формы
		$bookName = $_POST['book_name'];
		$author = $_POST['author'];
		$count = $_POST['count'];
		$image = $_POST['image'];

		$query = "INSERT INTO books (book_name, author, count, image) VALUES ('$bookName', '$author', $count, '$image')";

		if ($conn->query($query) === TRUE) {

			$query = "SELECT * FROM books ORDER BY id DESC LIMIT 1";
			$result = $conn->query($query);

			if ($result->num_rows > 0) {
				echo json_encode($result->fetch_assoc());
			} else {
				echo json_encode([]); // возвращаем пустой JSON-объект
			}
		} else {
			echo json_encode(['error' => 'Произошла ошибка при добавлении книги']);
		}
	} else {
		//POST запрос с JSON
		$bookName = $data['book_name'];
		$author = $data['author'];
		$count = $data['count'];
		$image = $data['image'];

		$query = "INSERT INTO books (book_name, author, count, image) VALUES ('$bookName', '$author', $count, '$image')";

		if ($conn->query($query) === TRUE) {

			$query = "SELECT * FROM books ORDER BY id DESC LIMIT 1";
			$result = $conn->query($query);

			if ($result->num_rows > 0) {
				echo json_encode($result->fetch_assoc());
			} else {
				echo json_encode([]); // возвращаем пустой JSON-объект
			}
		} else {
			echo json_encode(['error' => 'Произошла ошибка при добавлении книги']);
		}
	}
}
