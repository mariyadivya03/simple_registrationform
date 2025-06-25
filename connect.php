<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $fname = $_POST['FirstName'];
    $lname = $_POST['LastName'];
    $gender = $_POST['Gender'];
    $email = $_POST['Email'];
    $pass = password_hash($_POST['Password'], PASSWORD_DEFAULT); 
    $phone = $_POST['PhoneNo'];
    $course = $_POST['Course'];
    $languages = isset($_POST['Languages']) ? implode(", ", $_POST['Languages']) : '';

    // Resume file upload
    $resume = '';
    if (!empty($_FILES['resume']['name'])) {
        $targetDir = "uploads/";
        $originalFile = basename($_FILES["resume"]["name"]);
        $resume = time() . '_' . $originalFile;
        $targetFilePath = $targetDir . $resume;

        // Validate file
        $allowedTypes = ['pdf', 'doc', 'docx'];
        $fileType = strtolower(pathinfo($resume, PATHINFO_EXTENSION));

        if (!in_array($fileType, $allowedTypes)) {
            echo "Only PDF, DOC, DOCX files are allowed.";
            exit;
        }

        if ($_FILES['resume']['size'] > 2 * 1024 * 1024) {
            echo "Resume size should be less than 2MB.";
            exit;
        }

        if (!move_uploaded_file($_FILES["resume"]["tmp_name"], $targetFilePath)) {
            echo "Resume upload failed.";
            exit;
        }
    }

    $stmt = $conn->prepare("INSERT INTO registration (FirstName, LastName, Gender, Email, Password, PhoneNo, Course, Languages, Resume) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $fname, $lname, $gender, $email, $pass, $phone, $course, $languages, $resume);

    
   if ($stmt->execute()) {
    echo " Registered Successfully. Redirecting to login...";
    header("refresh:3; url=login.php");
    exit;
}
 else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
