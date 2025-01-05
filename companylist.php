<?php
// Assuming you have the user's name stored in a session variable named 'username'
session_start();
$loggedInUser = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; // Set to 'Guest' if not logged in
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
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

        a{
            text-decoration: none !important;
            color: white !important;
        }

        a:hover{
            color: black !important;
        }

        .uploaded-files a {
            text-decoration: none !important;
            color: white !important;
            transition: color 0.3s; /* Smooth color transition on hover */
        }

        .uploaded-files a:hover {
            color: #1a5ca1 !important; /* Change color on hover */
            background-color: white; /* Add background color on hover */
            border-radius: 5px; /* Add rounded corners on hover */
            padding: 5px; /* Add padding on hover */
        }

        .table-container {
        overflow-x: auto;
        max-width: 100%;
        margin-bottom: 20px;
        margin-top: 10vh;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            background-color: #fff; /* Table background color */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Table shadow */
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #1a5ca1; /* Header background color */
            color: #fff; /* Header text color */
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2; /* Alternate row background color */
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

            .table-container {
            overflow-x: scroll;
            padding: 0;
            margin-left: -20px;
            }
        }

    </style>
</head>
<body>
    <div class="navbar">
        <ul>
            <li class="listitems"><a href="student_dashboard.php">Home</a></li>
            <li class="listitems"><a href="companylist.php">Company List</a></li>
            <li class="listitems"><a href="letter.php">Upload</a></li>
            <li class="listitems"><a href="logout.php">Logout</a></li>
            <li style="margin-left: auto; color: white;"><span><?php echo $loggedInUser; ?></span></li>
        </ul>
    </div>
    <div class="container">
        <h2>Company List</h2>
        <!-- <form method="GET" action="">
        <input type="text" name="search" placeholder="Search...">
        <select name="column">
            <option value="Company Name">Company Name</option>
            <option value="Location">Location</option>
            <option value="HR Name">HR Name</option>
            <option value="HR Phone">HR Phone</option>
            <option value="HR Email">HR Email</option>
        </select>
        <input type="submit" value="Search">
    </form> -->
        <div class="table-container">
        <table id="companyList">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Location</th>
                    <th>HR Name</th>
                    <th>HR Phone</th>
                    <th>HR Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Assuming you have established a database connection
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

                // $searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
                // $searchColumn = isset($_GET['column']) ? $_GET['column'] : '';

                // echo "<table border='1'>";

                $sql = "SELECT * FROM company_list_trial";

                // Add conditions if search query and column are provided
                // if (!empty($searchQuery) && !empty($searchColumn)) {
                //     $sql .= " WHERE `$searchColumn` LIKE '%$searchQuery%'";
                // }
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Company Name"] . "</td>";
                        echo "<td>" . $row["Location"] . "</td>";
                        echo "<td>" . $row["HR Name"] . "</td>";
                        echo "<td>" . $row["HR Phone"] . "</td>";
                        echo "<td>" . $row["HR Email"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No data found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#companyList').DataTable();
    });
</script>
</body>
</html>
