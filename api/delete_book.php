<?php
include_once '../functions/connect.php';

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$jsonData = file_get_contents('php://input');
	// Decode the JSON data into a PHP associative array
	$data = json_decode($jsonData, true);

	$query = "DELETE FROM `books` WHERE `id` = '{$data['id']}'";

	if ($data === null) {
		// Обработка ошибки при декодировании JSON
		http_response_code(400); // Bad Request
		echo "Ошибка: Переданы некорректные данные.";
		exit;
	}

	$result = mysqli_query($conn, $query);

	if ($result) {
		http_response_code(200); // OK
		echo "Книга успешно удалена.";
	} else {
		// Ошибка при выполнении запроса
		http_response_code(500); // Internal Server Error
		echo "Ошибка: Не удалось выполнить запрос.";
	}
}
