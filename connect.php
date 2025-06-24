<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $fname = $_POST['FirstName'];
    $lname = $_POST['LastName'];
    $gender = $_POST['Gender'];
    $email = $_POST['Email'];
    $pass = $_POST['Password'];
    $phone = $_POST['PhoneNo'];
    $course = $_POST['Course'];
    $languages = isset($_POST['Languages']) ? implode(", ", $_POST['Languages']) : '';

    
    $stmt = $conn->prepare("INSERT INTO registration (FirstName, LastName, Gender, Email, Password, PhoneNo, Course, Languages) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $fname, $lname, $gender, $email, $pass, $phone, $course, $languages);

    if ($stmt->execute()) {
        echo "Registered Successfully. <a href='list.php'>View List</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
