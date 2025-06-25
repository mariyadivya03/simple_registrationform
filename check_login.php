<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    echo "<h3>Debug Info</h3>";
    echo "Entered Email: " . htmlspecialchars($email) . "<br>";
    echo "Entered Password: " . htmlspecialchars($password) . "<br>";

    // Query DB
    $stmt = $conn->prepare("SELECT * FROM registration WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo "User Found.<br>";
        echo "Stored Hashed Password: " . $row['Password'] . "<br>";

        if (password_verify($password, $row['Password'])) {
            echo "✅ Password matched. Redirecting to list.php...";
            $_SESSION['user'] = $row['Email'];
            header("refresh:2; url=list.php"); // Wait 2 seconds and redirect
            exit;
        } else {
            echo "❌ password_verify() failed.<br>";
        }
    } else {
        echo "❌ No user found with this email.";
    }

    $stmt->close();
}
?>
