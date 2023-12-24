<?php
include_once "../functions/connect.php";

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$bookName = $_POST['book_name'];
	$author = $_POST['author'];
	$count = $_POST['count'];
	$image = $_POST['image'];

	$query = "INSERT INTO books (book_name, author, count, image) VALUES ('$bookName', '$author', $count, '$image')";

	if ($conn->query($query) === TRUE) {
		header('Location: ../pages/books/add_book.php?message=success');
	} else {
		header('Location: ../pages/books/add_book.php?message=error');
		exit;
	}
}
