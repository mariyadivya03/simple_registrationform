<?php
include 'db.php';
$result = $conn->query("SELECT * FROM registration");
?>

<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
</head>
<body>
    <h2>Users List</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th><th>First</th><th>Last</th><th>Gender</th>
            <th>Email</th><th>Phone</th><th>Course</th><th>Language Known</th>
            <th>Edit</th><th>Delete</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['FirstName'] ?></td>
            <td><?= $row['LastName'] ?></td>
            <td><?= $row['Gender'] ?></td>
            <td><?= $row['Email'] ?></td>
            <td><?= $row['PhoneNo'] ?></td>
            <td><?= $row['Course'] ?></td>
            <td><?= $row['Languages'] ?></td>
            <td><a href="edit.php?id=<?= $row['id'] ?>">Edit</a></td>
            <td><a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
