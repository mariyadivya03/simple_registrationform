<?php
include 'db.php';

$id = $_GET['id'];

// Fetch user data by ID
$result = $conn->query("SELECT * FROM registration WHERE id = $id");
$row = $result->fetch_assoc();

// Update when form submitted
if (isset($_POST['update'])) {
    $fname = $_POST['FirstName'];
    $lname = $_POST['LastName'];
    $gender = $_POST['Gender'];
    $email = $_POST['Email'];
    $phone = $_POST['PhoneNo'];
    $course = $_POST['Course'];
    $languages = isset($_POST['Languages']) ? implode(", ", $_POST['Languages']) : '';

    $stmt = $conn->prepare("UPDATE registration SET FirstName=?, LastName=?, Gender=?, Email=?, PhoneNo=?, Course=?, Languages=? WHERE id=?");
    $stmt->bind_param("sssssssi", $fname, $lname, $gender, $email, $phone, $course, $languages, $id);

    if ($stmt->execute()) {
        echo "Updated Successfully. <a href='list.php'>Back to List</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    exit;
}

// Prepare language checkboxes
$checkedLanguages = explode(", ", $row['Languages']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User Details</h2>
    <form method="post">
        First Name: <input type="text" name="FirstName" value="<?= $row['FirstName'] ?>" required><br><br>

        Last Name: <input type="text" name="LastName" value="<?= $row['LastName'] ?>" required><br><br>

        Gender:
        <input type="radio" name="Gender" value="Male" <?= ($row['Gender'] == 'Male') ? 'checked' : '' ?>> Male
        <input type="radio" name="Gender" value="Female" <?= ($row['Gender'] == 'Female') ? 'checked' : '' ?>> Female
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
        <input type="checkbox" name="Languages[]" value="Tamil" <?= in_array("Tamil", $checkedLanguages) ? 'checked' : '' ?>> Tamil
        <input type="checkbox" name="Languages[]" value="English" <?= in_array("English", $checkedLanguages) ? 'checked' : '' ?>> English
        <input type="checkbox" name="Languages[]" value="Hindi" <?= in_array("Hindi", $checkedLanguages) ? 'checked' : '' ?>> Hindi
       
        <br><br>

        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
