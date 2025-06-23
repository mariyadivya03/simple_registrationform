<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $FirstName = $_POST['FirstName'];
    $LastName  = $_POST['LastName'];
    $Gender    = $_POST['Gender'];
    $Email     = $_POST['Email'];
    $Password  = $_POST['Password'];
    $PhoneNo   = $_POST['PhoneNo'];

    if (!is_numeric($PhoneNo)) {
        die("Phone number should be numeric only.");
    }

    $conn = new mysqli('localhost', 'root', '', 'test1');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO registration (FirstName, LastName, Gender, Email, Password, PhoneNo) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $FirstName, $LastName, $Gender, $Email, $Password, $PhoneNo);

        if ($stmt->execute()) {
            header("Location: list.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    }
} else {
    echo "Invalid request.";
}
?>