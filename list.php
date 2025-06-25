


<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';
$result = $conn->query("SELECT * FROM registration");
?>

<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        th { background-color: #f2f2f2; }
        a { text-decoration: none; color: blue; }
    </style>
</head>
<body>
    <h2>Users List</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>First</th>
            <th>Last</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Course</th>
            <th>Language Known</th>
            <th>Resume</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        $i = 1;
        while($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $row['FirstName'] ?></td>
            <td><?= $row['LastName'] ?></td>
            <td><?= $row['Gender'] ?></td>
            <td><?= $row['Email'] ?></td>
            <td><?= $row['PhoneNo'] ?></td>
            <td><?= $row['Course'] ?></td>
            <td><?= $row['Languages'] ?></td>
            <td>
                <?php if (!empty($row['Resume'])): ?>
                    <a href="uploads/<?= $row['Resume'] ?>" target="_blank">View</a>
                <?php else: ?>
                    No file
                <?php endif; ?>
            </td>
            <td><a href="edit.php?id=<?= $row['id'] ?>">Edit</a></td>
            <td><a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
    <div style="text-align: center; margin-top: 20px;">
    <a href="logout.php" style="
        background-color: #007BFF;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        display: inline-block;
    ">Logout</a>
</div>

</body>
</html>
