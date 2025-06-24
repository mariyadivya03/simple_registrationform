<?php
include 'db.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fname = $_POST['FirstName'];
    $lname = $_POST['LastName'];
    $gender = $_POST['Gender'];
    $email = $_POST['Email'];
    $phone = $_POST['PhoneNo'];

    $sql = "UPDATE registration SET FirstName='$fname', LastName='$lname', Gender='$gender', Email='$email', PhoneNo='$phone' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: list.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
