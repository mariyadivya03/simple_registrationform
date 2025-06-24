

<?php
include 'db.php';

$id = $_GET['id'];

// Delete the record
$sql = "DELETE FROM registration WHERE id = $id";
mysqli_query($conn, $sql);

// Renumber IDs
mysqli_query($conn, "SET @num := 0");
mysqli_query($conn, "UPDATE registration SET id = @num := @num + 1");
mysqli_query($conn, "ALTER TABLE registration AUTO_INCREMENT = 1");

// Redirect back
header("Location: list.php");
?>

