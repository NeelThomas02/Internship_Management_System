<?php
$host_name = "localhost";
$username = "root";
$password = "";
$db_name = "user_management";

// Create connection
$conn = new mysqli($host_name, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$notFilledQuery = "SELECT username FROM users WHERE user_role = 'student' AND username NOT IN (SELECT username FROM internship_form) AND username NOT IN (SELECT username from accepted_requests)";

$notFilledResult = $conn->query($notFilledQuery);

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=students_not_filled_form.csv');

$output = fopen('php://output', 'w');

fputcsv($output, array('Student ID'));

while ($notFilledRow = $notFilledResult->fetch_assoc()) {
    fputcsv($output, array($notFilledRow["username"]));
}

fclose($output);
$conn->close();
?>