<?php
include 'db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM registration WHERE id = $id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head><title>Edit</title></head>
<body>
    <h2>Edit User</h2>
    <form method="POST" action="update.php">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">

        First Name: <input type="text" name="FirstName" value="<?= $row['FirstName'] ?>"><br><br>
        Last Name: <input type="text" name="LastName" value="<?= $row['LastName'] ?>"><br><br>
        Gender:
        <select name="Gender">
            <option <?= $row['Gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
            <option <?= $row['Gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
            <option <?= $row['Gender'] == 'Others' ? 'selected' : '' ?>>Others</option>
        </select><br><br>
        Email: <input type="email" name="Email" value="<?= $row['Email'] ?>"><br><br>
        Phone: <input type="text" name="PhoneNo" value="<?= $row['PhoneNo'] ?>"><br><br>

        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
