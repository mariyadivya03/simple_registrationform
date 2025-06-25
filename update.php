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

    // File upload handling
    $resume = ''; // default
    if (!empty($_FILES['resume']['name'])) {
        $targetDir = "uploads/";
        $resume = basename($_FILES["resume"]["name"]);
        $targetFilePath = $targetDir . $resume;

        if (move_uploaded_file($_FILES["resume"]["tmp_name"], $targetFilePath)) {
            // File uploaded successfully
        } else {
            echo "Error uploading resume.";
            exit;
        }
    }

    // If resume uploaded, update it; else skip resume update
    
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

    if ($stmt->execute()) {
        header("Location: list.php");
        exit;
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}
?>
