<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id']; // Get the submission ID

// Fetch submission details
$sql = "SELECT * FROM internship_form WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the submission data
    $row = $result->fetch_assoc();

    // Insert data into 'Accepted' table
    $acceptedSql = "INSERT INTO accepted_requests (studentId, fullName, branch, semester, learningMode, companyName, confirmedTechnology, companyCity, companyAddress, companyWebsite, hrName, hrEmail, hrContact)
                    VALUES ('" . $row['studentId'] . "', '" . $row['fullName'] . "', '" . $row['branch'] . "', '" . $row['semester'] . "', '" . $row['learningMode'] . "', '" . $row['companyName'] . "', '" . $row['confirmedTechnology'] . "', '" . $row['companyCity'] . "', '" . $row['companyAddress'] . "', '" . $row['companyWebsite'] . "', '" . $row['hrName'] . "', '" .$row['hrEmail'] . "', '" .$row['hrContact'] . "')";

    if ($conn->query($acceptedSql) === TRUE) {
        // Delete the entry from 'Internship Form' table
        $deleteSql = "DELETE FROM internship_form WHERE id = $id";

        if ($conn->query($deleteSql) === TRUE) {
            // Set session variable for success message
            session_start();
            $_SESSION['message'] = "Request accepted successfully.";

            // Redirect back to the admin dashboard or any suitable page
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Error inserting record: " . $conn->error;
    }
} else {
    echo "Submission not found.";
}

$conn->close();
?>
