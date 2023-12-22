<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            overflow-x: hidden;
            background-color: #E8F7FE;
            margin: 0;
            padding: 0;
        }

        .navbar {
            margin-top: -2.5vh;
            padding: 0;
            width: 100%;
        }

        ul {
            list-style: none;
            display: flex;
            background-color: #1a5ca1;
            height: 5vh;
            align-items: center;
            padding-left: 2vh;
            width: 100%;
        }

        ul li {
            padding-right: 10vh;
        }

        a {
            text-decoration: none !important;
            color: white !important;
        }

        a:hover {
            color: black !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #1a5ca1;
            color: white;
        }

        .accept-btn, .reject-btn {
        display: inline-block;
        padding: 5px 10px;
        margin-right: 5px;
        border-radius: 4px;
        text-decoration: none;
        color: #fff;
        cursor: pointer;
    }

    .accept-btn {
        background-color: #5cb85c; /* Green color for accept button */
    }

    .reject-btn {
        background-color: #d9534f; /* Red color for reject button */
    }

    .undo-btn {
        display: inline-block;
        padding: 5px 10px;
        margin-right: 5px;
        border-radius: 4px;
        text-decoration: none;
        color: #fff;
        cursor: pointer;
        background-color: #f0ad4e; /* Orange color for undo button */
    }

    .undo-btn:hover {
        background-color: #ec971f; /* Darker orange color on hover */
    }
    </style>
</head>
<body>
<div class="navbar">
    <ul>
        <li class="listitems"><a href="admin_dashboard.html">Home</a></li>
        <li class="listitems"><a href="admin_company_list.php">Company List</a></li>
        <!-- <li class="listitems"><a href="admin_letter.php">Student Documents</a></li> -->
        <li class="listitems"><a href="admin_offer_letter.php">Student Offer Letter</a></li>
        <li class="listitems"><a href="admin_completion_letter.php">Student Completion Letter</a></li>
        <!-- <li class="listitems"><a href="upload.html">Upload</a></li> -->
        <li class="listitems"><a href="logout.php">Logout</a></li>
    </ul>
</div>
<div class="container">
    <h1>Student Submissions</h1>
    <div class="submission-list">
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Count total number of students
$totalStudentsQuery = "SELECT COUNT(*) as totalStudents FROM users WHERE user_role = 'student'";
$totalStudentsResult = $conn->query($totalStudentsQuery);
$totalStudentsRow = $totalStudentsResult->fetch_assoc();
$totalStudents = $totalStudentsRow['totalStudents'];

$acceptedStudentsQuery = "SELECT COUNT(*) as acceptedStudents FROM accepted_requests";
$acceptedStudentsResult = $conn->query($acceptedStudentsQuery);
$acceptedStudentsRow = $acceptedStudentsResult->fetch_assoc();
$acceptedStudents = $acceptedStudentsRow['acceptedStudents'];

$sql = "SELECT * FROM internship_form";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $filledForms = $result->num_rows;
    $remainingForms = $totalStudents - $filledForms;

    echo "<h2>Form Status</h2>";
    echo "<p>Total Students: $totalStudents</p>";
    echo "<p>Students who have filled the form: $filledForms</p>";
    echo "<p>Students who have not filled the form: $remainingForms</p>";
    echo "<p>Students accepted for internship: $acceptedStudents</p>"; // Display count of accepted students

    echo "<h2>Student Submissions</h2>";
    echo "<table>";
    echo "<tr><th>Student ID</th><th>Full Name</th><th>Branch</th><th>Company</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["studentId"] . "</td>";
        echo "<td>" . $row["fullName"] . "</td>";
        echo "<td>" . $row["branch"] . "</td>";
        // Display other fields similarly
        echo "<td>" . $row["companyName"] . "</td>";
        echo "<td>";
        // Add accept and reject buttons with links to trigger PHP actions
        echo "<a class='accept-btn' href='accepted_requests.php?id=" . $row['id'] . "&status=Accepted'>Accept</a> | ";
        echo "<a class='reject-btn' href='rejected_requests.php?id=" . $row['id'] . "&status=Rejected'>Reject</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No submissions yet.</p>";
}

?>

    </div>
</div>
<div class="accepted-requests">
    <h2>Accepted Requests</h2>
    <table>
        <tr>
            <th>Student ID</th>
            <th>Full Name</th>
            <th>Branch</th>
            <th>Company</th>
            <th>Action</th>
        </tr>
        <?php
        // Retrieve accepted requests from the database
        $acceptedQuery = "SELECT * FROM accepted_requests";
        $acceptedResult = $conn->query($acceptedQuery);

        if ($acceptedResult->num_rows > 0) {
            while ($row = $acceptedResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["studentId"] . "</td>";
                echo "<td>" . $row["fullName"] . "</td>";
                echo "<td>" . $row["branch"] . "</td>";
                echo "<td>" . $row["companyName"] . "</td>";
                echo "<td>";
                // Add undo button with a link to trigger PHP action to revert status
                echo "<a class='undo-btn' href='undo_accepted_status.php?id=" . $row['id'] . "'>Undo</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No accepted requests yet.</td></tr>";
        }
        ?>
    </table>
</div>

<div class="rejected-requests">
    <h2>Rejected Requests</h2>
    <table>
        <tr>
            <th>Student ID</th>
            <th>Full Name</th>
            <th>Branch</th>
            <th>Company</th>
            <th>Action</th>
        </tr>
        <?php
        // Retrieve rejected requests from the database
        $rejectedQuery = "SELECT * FROM rejected_requests";
        $rejectedResult = $conn->query($rejectedQuery);

        if ($rejectedResult->num_rows > 0) {
            while ($row = $rejectedResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["studentId"] . "</td>";
                echo "<td>" . $row["fullName"] . "</td>";
                echo "<td>" . $row["branch"] . "</td>";
                echo "<td>" . $row["companyName"] . "</td>";
                echo "<td>";
                // Add undo button with a link to trigger PHP action to revert status
                echo "<a class='undo-btn' href='undo_rejected_status.php?id=" . $row['id'] . "'>Undo</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No rejected requests yet.</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</div>
</body>
</html>
