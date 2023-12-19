<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the data to be moved back to pending submissions
    $retrieveQuery = "SELECT * FROM accepted_requests WHERE id = $id"; // Modify for rejected requests
    $retrieveResult = $conn->query($retrieveQuery);

    if ($retrieveResult->num_rows > 0) {
        $row = $retrieveResult->fetch_assoc();

        // Move the data back to pending submissions
        $moveQuery = "INSERT INTO internship_form (studentId, fullName, branch, semester, learningMode, companyName, confirmedTechnology, companyCity, companyAddress, companyWebsite, hrName, hrEmail, hrContact)
        VALUES ('" . $row['studentId'] . "', '" . $row['fullName'] . "', '" . $row['branch'] . "', '" . $row['semester'] . "', '" . $row['learningMode'] . "', '" . $row['companyName'] . "', '" . $row['confirmedTechnology'] . "', '" . $row['companyCity'] . "', '" . $row['companyAddress'] . "', '" . $row['companyWebsite'] . "', '" . $row['hrName'] . "', '" .$row['hrEmail'] . "', '" .$row['hrContact'] . "')";
        $moveResult = $conn->query($moveQuery);

        if ($moveResult === TRUE) {
            // Remove the entry from accepted or rejected requests
            $deleteQuery = "DELETE FROM accepted_requests WHERE id = $id"; // Modify for rejected requests
            $deleteResult = $conn->query($deleteQuery);

            if ($deleteResult === TRUE) {
                // Redirect back to the admin dashboard after successful undo
                header("Location: admin_dashboard.php");
                exit();
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } else {
            echo "Error moving record: " . $conn->error;
        }
    }
}

$conn->close();
?>
