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
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $fullName = mysqli_real_escape_string($conn, $_POST["fullName"]);
    $branch = mysqli_real_escape_string($conn, $_POST["branch"]);
    $semester = mysqli_real_escape_string($conn, $_POST["semester"]);
    $learningMode = mysqli_real_escape_string($conn, $_POST["learningMode"]);
    $typeofinternship = mysqli_real_escape_string($conn, $_POST["typeofinternship"]);
    $companyName = mysqli_real_escape_string($conn, $_POST["companyName"]);
    $confirmedTechnology = mysqli_real_escape_string($conn, $_POST["confirmedTechnology"]);
    $companyCity = mysqli_real_escape_string($conn, $_POST["companyCity"]);
    $companyAddress = mysqli_real_escape_string($conn, $_POST["companyAddress"]);
    $companyWebsite = mysqli_real_escape_string($conn, $_POST["companyWebsite"]);
    $hrName = mysqli_real_escape_string($conn, $_POST["hrName"]);
    $hrEmail = mysqli_real_escape_string($conn, $_POST["hrEmail"]);
    $hrContact = mysqli_real_escape_string($conn, $_POST["hrContact"]);

    // Insert the form data into the table
    $sql = "INSERT INTO internship_form (username, fullName, branch, semester, learningMode, typeofinternship, companyName, confirmedTechnology, companyCity, companyAddress, companyWebsite, hrName, hrEmail, hrContact) VALUES ('$username', '$fullName', '$branch', '$semester', '$learningMode', '$typeofinternship', '$companyName', '$confirmedTechnology', '$companyCity', '$companyAddress', '$companyWebsite', '$hrName', '$hrEmail', '$hrContact')";

    if ($conn->query($sql) === TRUE) {
        // Set a session message for successful submission
        $_SESSION['message'] = "New record created successfully";
    } else {
        // Handle errors if needed
        $_SESSION['message'] = "Error creating record: " . $conn->error;
    }

    $conn->close();
}
?>

