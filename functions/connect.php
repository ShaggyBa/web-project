<?php
$server_name = "localhost";
// $user = "root"; 
$user = "shaggyba";
// $password = ""; 
$password = "321654987s";
// $db = "web-project"; 
$db = "web_project";

$conn = new mysqli($server_name, $user, $password, $db);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
