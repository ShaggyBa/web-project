<?php
session_start();

// Очистка переменных сессии
$_SESSION = array();

// Уничтожение сессии
session_destroy();
header('Location: ../index.php');
