<?php
//koneksi database
$servername = "%"; // servernya untuk "any host"
$username = "task";
$password = "12345678";
$dbname = "task_manager";
$tableName = "tasks";

$conn = new mysqli("127.0.0.1", $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
