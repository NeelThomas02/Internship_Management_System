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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = $_POST["company_name"];
    $location = $_POST["location"];
    $hr_name = $_POST["hr_name"];
    $hr_phone = $_POST["hr_phone"];
    $hr_email = $_POST["hr_email"];

    // Insert into displayed table
    $insert_query = "INSERT INTO displayed_table (`Company Name`, `Location`, `HR Name`, `HR Phone`, `HR Email`) VALUES ('$company_name', '$location', '$hr_name', '$hr_phone', '$hr_email')";
    $result = $conn->query($insert_query);

    // Insert into company_list_trial table
    $insert_query_trial = "INSERT INTO company_list_trial (`Company Name`, `Location`, `HR Name`, `HR Phone`, `HR Email`) VALUES ('$company_name', '$location', '$hr_name', '$hr_phone', '$hr_email')";
    $result_trial = $conn->query($insert_query_trial);

    if ($result && $result_trial) {
        header("Location: admin_company_list.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
