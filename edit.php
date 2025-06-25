<?php
include 'db.php';

$id = $_GET['id'];

// Fetch existing user data
$result = $conn->query("SELECT * FROM registration WHERE id = $id");
$row = $result->fetch_assoc();

// Update when submitted
if (isset($_POST['update'])) {
    $fname = $_POST['FirstName'];
    $lname = $_POST['LastName'];
    $gender = $_POST['Gender'];
    $email = $_POST['Email'];
    $phone = $_POST['PhoneNo'];
    $course = $_POST['Course'];
    $languages = isset($_POST['Languages']) ? implode(", ", $_POST['Languages']) : '';

    // Handle resume upload
    $resume = $row['Resume']; // fallback to old resume
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
        $resume = basename($_FILES['resume']['name']);
        $target = "uploads/" . $resume;
        move_uploaded_file($_FILES['resume']['tmp_name'], $target);
    }

    // Update DB
    $stmt = $conn->prepare("UPDATE registration SET FirstName=?, LastName=?, Gender=?, Email=?, PhoneNo=?, Course=?, Languages=?, Resume=? WHERE id=?");
    $stmt->bind_param("ssssssssi", $fname, $lname, $gender, $email, $phone, $course, $languages, $resume, $id);

    if ($stmt->execute()) {
        echo " Updated Successfully. <a href='list.php'>Back to List</a>";
    } else {
        echo " Error: " . $stmt->error;
    }

    $stmt->close();
    exit;
}

$checkedLanguages = explode(", ", $row['Languages']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User Details</h2>
    <form method="post" enctype="multipart/form-data">

        First Name: <input type="text" name="FirstName" value="<?= $row['FirstName'] ?>" required><br><br>

        Last Name: <input type="text" name="LastName" value="<?= $row['LastName'] ?>" required><br><br>

        Gender:
        <input type="radio" name="Gender" value="Male" <?= ($row['Gender'] == 'Male') ? 'checked' : '' ?>> Male
        <input type="radio" name="Gender" value="Female" <?= ($row['Gender'] == 'Female') ? 'checked' : '' ?>> Female
        <input type="radio" name="Gender" value="Others" <?= ($row['Gender'] == 'Others') ? 'checked' : '' ?>> Others
        <br><br>

        Email: <input type="email" name="Email" value="<?= $row['Email'] ?>" required><br><br>

        Phone No: <input type="text" name="PhoneNo" value="<?= $row['PhoneNo'] ?>" required><br><br>

        Course:
        <select name="Course" required>
            <option value="">--Select Course--</option>
            <option value="MCA" <?= ($row['Course'] == 'MCA') ? 'selected' : '' ?>>MCA</option>
            <option value="BCA" <?= ($row['Course'] == 'BCA') ? 'selected' : '' ?>>BCA</option>
            <option value="B.Sc CS" <?= ($row['Course'] == 'B.Sc CS') ? 'selected' : '' ?>>B.Sc Computer Science</option>
            <option value="B.Tech IT" <?= ($row['Course'] == 'B.Tech IT') ? 'selected' : '' ?>>B.Tech IT</option>
        </select><br><br>

        Languages Known:<br>
        <input type="checkbox" name="Languages[]" value="Tamil" <?= in_array("Tamil", $checkedLanguages) ? 'checked' : '' ?>> Tamil<br>
        <input type="checkbox" name="Languages[]" value="English" <?= in_array("English", $checkedLanguages) ? 'checked' : '' ?>> English<br>
        <input type="checkbox" name="Languages[]" value="Hindi" <?= in_array("Hindi", $checkedLanguages) ? 'checked' : '' ?>> Hindi<br><br>

        Resume Upload: <input type="file" name="resume" accept=".pdf,.doc,.docx"><br>
        <?php if (!empty($row['Resume'])): ?>
             <a href="uploads/<?= $row['Resume'] ?>" target="_blank">View Uploaded Resume</a><br><br>
        <?php endif; ?>

        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
