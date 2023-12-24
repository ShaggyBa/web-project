<?php
include_once '../functions/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$jsonData = file_get_contents('php://input');
	// Decode the JSON data into a PHP associative array
	$data = json_decode($jsonData, true);

	if ($data === null) {
		// Обработка ошибки при декодировании JSON
		http_response_code(400); // Bad Request
		echo "Ошибка: Переданы некорректные данные.";
		exit;
	}

	$id = $data['id'];
	$role = $data['role'];

	$query = "UPDATE `users` SET `role` = '$role' WHERE `id` = '$id'";

	$result = mysqli_query($conn, $query);

	if ($result) {
		// Роль пользователя успешно обновлена
		echo "Роль пользователя успешно обновлена.";
	} else {
		// Ошибка при выполнении запроса
		http_response_code(500); // Internal Server Error
		echo "Ошибка: Не удалось обновить роль пользователя.";
	}
}
