<?php
// Establish a connection to the MySQL database in XAMPP
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Use PHP code to retrieve the form data and store it in variables
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentId = mysqli_real_escape_string($conn, $_POST["studentId"]);
    $fullName = mysqli_real_escape_string($conn, $_POST["fullName"]);
    $branch = mysqli_real_escape_string($conn, $_POST["branch"]);
    $semester = mysqli_real_escape_string($conn, $_POST["semester"]);
    $learningMode = mysqli_real_escape_string($conn, $_POST["learningMode"]);
    $companyName = mysqli_real_escape_string($conn, $_POST["companyName"]);
    $confirmedTechnology = mysqli_real_escape_string($conn, $_POST["confirmedTechnology"]);
    $companyCity = mysqli_real_escape_string($conn, $_POST["companyCity"]);
    $companyAddress = mysqli_real_escape_string($conn, $_POST["companyAddress"]);
    $companyWebsite = mysqli_real_escape_string($conn, $_POST["companyWebsite"]);
    $hrName = mysqli_real_escape_string($conn, $_POST["hrName"]);
    $hrEmail = mysqli_real_escape_string($conn, $_POST["hrEmail"]);
    $hrContact = mysqli_real_escape_string($conn, $_POST["hrContact"]);

    // Insert the form data into the table
    $sql = "INSERT INTO internship_form (studentId, fullName, branch, semester, learningMode, companyName, confirmedTechnology, companyCity, companyAddress, companyWebsite, hrName, hrEmail, hrContact) VALUES ('$studentId', '$fullName', '$branch', '$semester', '$learningMode', '$companyName', '$confirmedTechnology', '$companyCity', '$companyAddress', '$companyWebsite', '$hrName', '$hrEmail', '$hrContact')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>