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
            <li class="listitems"><a href="student_dashboard.php">Home</a></li>
            <li class="listitems"><a href="companylist.php">Company List</a></li>
            <li class="listitems"><a href="letter.php">Upload</a></li>
            <li class="listitems"><a href="logout.php">Logout</a></li>
            <li style="margin-left: auto; color: white;"><span><?php echo $loggedInUser; ?></span></li>
        </ul>
    </div>
    <div class="container">
        <h2>Company List</h2>
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search...">
            <input type="submit" value="Search">
        </form>
        
        <?php
        $targetDir = "uploads/";
        $files = glob($targetDir . '*.xlsx');

        if (!empty($files)) {
            $latestFile = max($files);

            require 'vendor/autoload.php';
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($latestFile);
            $worksheet = $spreadsheet->getActiveSheet();

            // Fetching search query if it exists
            $searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';

            echo "<table border='1'>";
            foreach ($worksheet->getRowIterator() as $row) {
                $found = false;
                foreach ($row->getCellIterator() as $cell) {
                    $cellValue = $cell->getValue();

                    // Check if the search query matches any cell value in the row
                    if (strpos($cellValue, $searchQuery) !== false) {
                        $found = true;
                        break;
                    }
                }

                // Display the row if it contains the search query or if no search query is specified
                if ($found || empty($searchQuery)) {
                    echo "<tr>";
                    foreach ($row->getCellIterator() as $cell) {
                        echo "<td>" . $cell->getValue() . "</td>";
                    }
                    echo "</tr>";
                }
            }
            echo "</table>";
        } else {
            echo "No uploaded Excel files found.";
        }
        ?>
    </div>
</body>
</html>
