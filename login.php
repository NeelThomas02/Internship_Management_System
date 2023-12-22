<?php
session_start();

// Check if the user is already logged in (by checking the session)
if (isset($_SESSION['username'])) {
    // Redirect to the appropriate dashboard based on the user role
    if ($_SESSION['user_role'] == 'student') {
        header("Location: student_dashboard.php");
    } elseif ($_SESSION['user_role'] == 'admin') {
        header("Location: admin_dashboard.php");
    }
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Database connection parameters
    $db_host = "localhost"; // Hostname of your MySQL server (usually "localhost" in XAMPP)
    $db_user = "root"; // MySQL username in XAMPP (default is "root")
    $db_pass = ""; // MySQL password in XAMPP (empty by default)
    $db_name = "user_management"; // Your database name

    // Create a database connection
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query the database to check if the entered credentials are valid
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Successful login
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_role'] = $row['user_role'];

        // Redirect to the appropriate dashboard based on the user role
        if ($_SESSION['user_role'] == 'student') {
            header("Location: student_dashboard.php");
        } elseif ($_SESSION['user_role'] == 'admin') {
            header("Location: admin_dashboard.php");
        }
        exit();
    } else {
        // Invalid login, display an error message
        echo "Invalid username or password.";
    }

    // Close the database connection
    $conn->close();
}
?>
