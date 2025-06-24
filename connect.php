<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $fname = $_POST['FirstName'];
    $lname = $_POST['LastName'];
    $gender = $_POST['Gender'];
    $email = $_POST['Email'];
    $pass = $_POST['Password'];
    $phone = $_POST['PhoneNo'];

    $stmt = $conn->prepare("INSERT INTO registration (FirstName, LastName, Gender, Email, Password, PhoneNo) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fname, $lname, $gender, $email, $pass, $phone);

    if ($stmt->execute()) {
        echo "Registered Successfully. <a href='list.php'>View List</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
