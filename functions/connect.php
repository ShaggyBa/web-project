<?php
$server_name = "localhost";
$user = "shaggyba"; // $user = "root";
$password = "321654987s";  // $password = ""; 
$db = "web_project"; //  $db = "web-project";

$conn = new mysqli($server_name, $user, $password, $db);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
