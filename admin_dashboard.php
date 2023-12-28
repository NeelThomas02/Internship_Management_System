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
            height: max-content;
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

    #not-filled-list {
    list-style-type: none;
    padding: 0;
    }

    .not-filled-item {
    background-color: #f00;
    color: #fff;
    padding: 5px;
    margin-bottom: 2px;
    }

    .company-link {
    color: blue !important;
    text-decoration: underline;
    }
    .company-link:hover {
    color: darkblue;
    text-decoration: underline;
    }

    @media screen and (max-width: 770px) {
    .navbar ul {
        flex-direction: column;
        height: auto;
        padding: 0;
    }

    .navbar ul li {
        padding: 10px 0;
        width: 100%;
        text-align: center;
    }
}
</style>

</head>
<body>
<div class="navbar">
    <ul>
        <li class="listitems"><a href="admin_dashboard.php">Home</a></li>
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

$acceptedCountQuery = "SELECT COUNT(*) as acceptedCount FROM accepted_requests";
$rejectedCountQuery = "SELECT COUNT(*) as rejectedCount FROM rejected_requests";

$acceptedCountResult = $conn->query($acceptedCountQuery);
$rejectedCountResult = $conn->query($rejectedCountQuery);

$acceptedCountRow = $acceptedCountResult->fetch_assoc();
$rejectedCountRow = $rejectedCountResult->fetch_assoc();

$acceptedCount = $acceptedCountRow['acceptedCount'];
$rejectedCount = $rejectedCountRow['rejectedCount'];

$totalStudentsQuery = "SELECT COUNT(*) as totalStudents FROM users WHERE user_role = 'student'";
$totalStudentsResult = $conn->query($totalStudentsQuery);
$totalStudentsRow = $totalStudentsResult->fetch_assoc();
$totalStudents = $totalStudentsRow['totalStudents'];

$filledFormsQuery = "SELECT COUNT(*) as filledForms FROM internship_form";
$filledFormsResult = $conn->query($filledFormsQuery);
$filledFormsRow = $filledFormsResult->fetch_assoc();
$filledForms = $filledFormsRow['filledForms'];

$totalFilledForms = $filledForms + $acceptedCount; // Update total filled forms with accepted count

$remainingForms = $totalStudents - $totalFilledForms;
$notFilledQuery = "SELECT username FROM users WHERE user_role = 'student' AND username NOT IN (SELECT username FROM internship_form) AND username NOT IN (SELECT username from accepted_requests)";
$notFilledResult = $conn->query($notFilledQuery);



?>

    <h2>Form Status</h2>
    <p>Total Students: <?php echo $totalStudents; ?></p>
    <p>Students who have filled the form: <?php echo $totalFilledForms; ?></p>
    <p>Students who have not filled the form: <?php echo $remainingForms; ?></p>
    <p>Students accepted for internship: <?php echo $acceptedCount; ?></p>
    <p>Students rejected for internship: <?php echo $rejectedCount; ?></p>

    <h2>Students Who Have Not Filled the Form</h2>
    <?php
    if ($notFilledResult->num_rows > 0) {
        echo "<ul id='not-filled-list'>";
        while ($notFilledRow = $notFilledResult->fetch_assoc())     {
            echo "<li class='not-filled-item'>" . $notFilledRow["username"] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>All students have filled the form.</p>";
    }
    ?>
    <p><a href="download_not_filled.php" style="text-decoration: none; color: #000; background-color: #ccc; padding: 5px; border-radius: 5px;">Download the list</a></p>


    <h1>Student Submissions</h1>
        <div class="submission-list">
            <?php
            if ($result->num_rows > 0) {
                // Display student submissions
                echo "<table>";
                echo "<tr><th>Student ID</th><th>Full Name</th><th>Company</th><th>HR Name</th><th>HR Email</th><th>HR Contact</th><th>Company Website</th><th>Type of Internship</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["fullName"] . "</td>";
                    echo "<td>" . $row["companyName"] . "</td>";
                    echo "<td>" . $row["hrName"] . "</td>";
                    echo "<td>" . $row["hrEmail"] . "</td>";
                    echo "<td>" . $row["hrContact"] . "</td>";
                    echo "<td> <a class='company-link' href='". $row["companyWebsite"] ."' target='_blank'>" .$row["companyWebsite"] . "</a></td>";
                    echo "<td>" . $row["typeofinternship"] . "</td>";
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
                echo "<td>" . $row["username"] . "</td>";
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
                echo "<td>" . $row["username"] . "</td>";
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
