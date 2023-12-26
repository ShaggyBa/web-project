<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once '../functions/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


	$book_id = $_POST['book_id'];
	$book_name = $_POST['book_name'];
	$author = $_POST['author'];
	$count = $_POST['count'];
	$image = $_POST['image'];


	$query = "UPDATE `books` SET `book_name` = '$book_name', `author` = '$author', `count` = '$count', `image` = '$image' WHERE `id` = '$book_id'";;

	$result = $conn->query($query);

	if ($result) {
		$success_message = "book_updated";
		header('Location:' . '../pages/books/books_edit.php?message=' . $success_message . '&book_id=' . $book_id);
	} else {
		$error_message = "cannot_update_method_error";
		header('Location:' . '../pages/books/books_edit.php?message=' . $error_message . '&book_id=' . $book_id);
	}
} else {
	$error_message = "request_method_error";
	echo ($error_message);
}
