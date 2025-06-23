<?php
$conn = new mysqli('localhost', 'root', '', 'test1');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$conn->query("DELETE FROM registration WHERE id=$id");
header("Location: list.php");
exit;
?>