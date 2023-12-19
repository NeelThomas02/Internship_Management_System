<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id']) && isset($_GET['status'])) {
    $studentId = $_GET['id'];
    $status = $_GET['status'];

    // Update the status in the database
    $updateStatusQuery = "UPDATE internship_form SET status='$status' WHERE id='$studentId'";
    if ($conn->query($updateStatusQuery) === TRUE) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error updating status: " . $conn->error;
    }
}

$conn->close();
?>
