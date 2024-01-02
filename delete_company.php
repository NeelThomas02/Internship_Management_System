<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";
//delete_company.php
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get company name from query string
$company_name = $_GET["id"];

// Delete company from displayed_table
$delete_query = "DELETE FROM displayed_table WHERE `Company Name` = '$company_name'";
$result = $conn->query($delete_query);

// Delete company from company_list_trial table
$delete_query_trial = "DELETE FROM company_list_trial WHERE `Company Name` = '$company_name'";
$result_trial = $conn->query($delete_query_trial);

if ($result && $result_trial) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>