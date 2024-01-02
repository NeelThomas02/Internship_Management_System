<?php
session_start();

// Establish a connection to the MySQL database in XAMPP
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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

    // Check if the company name exists in the company_list_trial table
    $checkQuery = "SELECT * FROM company_list_trial WHERE `Company Name` = '$companyName'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows == 0) {
        // If the company name doesn't exist, insert it into the company_list_trial table
        $insertQuery = "INSERT INTO company_list_trial (`Company Name`, `Location`, `HR Name`, `HR Phone`, `HR Email`) VALUES ('$companyName', '$companyCity', '$hrName', '$hrContact', '$hrEmail')";
        if ($conn->query($insertQuery) === TRUE) {
            $_SESSION['message'] = "New company added to company_list_trial!";
        } else {
            $_SESSION['message'] = "Error adding new company: " . $conn->error;
        }
    }

    // Insert the form data into the internship_form table
    $sql = "INSERT INTO internship_form (username, fullName, branch, semester, learningMode, typeofinternship, companyName, confirmedTechnology, companyCity, companyAddress, companyWebsite, hrName, hrEmail, hrContact) VALUES ('$username', '$fullName', '$branch', '$semester', '$learningMode', '$typeofinternship', '$companyName', '$confirmedTechnology', '$companyCity', '$companyAddress', '$companyWebsite', '$hrName', '$hrEmail', '$hrContact')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "New record created successfully";
    } else {
        $_SESSION['message'] = "Error creating record: " . $conn->error;
    }

    $conn->close();

    // Redirect back to the form page
    // header("Location: internship_application_form.php");
    exit();
}
?>
