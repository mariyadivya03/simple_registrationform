<?php
$conn = new mysqli('localhost', 'root', '', 'test1');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $FirstName = $_POST['FirstName'];
    $LastName  = $_POST['LastName'];
    $Gender    = $_POST['Gender'];
    $Email     = $_POST['Email'];
    $PhoneNo   = $_POST['PhoneNo'];

    $stmt = $conn->prepare("UPDATE registration SET FirstName=?, LastName=?, Gender=?, Email=?, PhoneNo=? WHERE id=?");
    $stmt->bind_param("sssssi", $FirstName, $LastName, $Gender, $Email, $PhoneNo, $id);
    $stmt->execute();

    echo "Updated successfully. <a href='list.php'>Go back</a>";
    exit;
}

$result = $conn->query("SELECT * FROM registration WHERE id=$id");
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head><title>Edit User</title></head>
<body>
    <h2>Edit User</h2>
    <form method="POST">
        First Name: <input type="text" name="FirstName" value="<?= $data['FirstName'] ?>"><br><br>
        Last Name: <input type="text" name="LastName" value="<?= $data['LastName'] ?>"><br><br>
        Gender:
        <input type="radio" name="Gender" value="Male" <?= $data['Gender']=='Male'?'checked':'' ?>>Male
        <input type="radio" name="Gender" value="Female" <?= $data['Gender']=='Female'?'checked':'' ?>>Female
        <input type="radio" name="Gender" value="Others" <?= $data['Gender']=='Others'?'checked':'' ?>>Others<br><br>
        Email: <input type="email" name="Email" value="<?= $data['Email'] ?>"><br><br>
        Phone No: <input type="text" name="PhoneNo" value="<?= $data['PhoneNo'] ?>"><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>