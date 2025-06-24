<?php
include 'db.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fname = $_POST['FirstName'];
    $lname = $_POST['LastName'];
    $gender = $_POST['Gender'];
    $email = $_POST['Email'];
    $phone = $_POST['PhoneNo'];
    $course = $_POST['Course'];
    $languages = isset($_POST['Languages']) ? implode(", ", $_POST['Languages']) : '';

    $stmt = $conn->prepare("UPDATE registration SET FirstName = ?, LastName = ?, Gender = ?, Email = ?, PhoneNo = ?, Course = ?, Languages = ? WHERE id = ?");
    $stmt->bind_param("sssssssi", $fname, $lname, $gender, $email, $phone, $course, $languages, $id);

    if ($stmt->execute()) {
        header("Location: list.php");
        exit;
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}
?>
