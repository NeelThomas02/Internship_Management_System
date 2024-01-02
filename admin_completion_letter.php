<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Completion Letter</title>
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
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #1a5ca1;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a.open-tab-btn {
            display: inline-block;
            padding: 6px 12px;
            background-color: #1a5ca1;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        a.open-tab-btn:hover {
            background-color: #0e3a6e;
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
<h1>Uploaded Offer Letters</h1>
    <div class="search-sort">
        <form action="" method="GET">
            <label for="search">Search Roll ID:</label>
            <input type="text" id="search" name="search">
            <button type="submit">Search</button>
        </form>
    </div>
<div class="file-list">
    <table>
        <thead>
            <tr>
                <th>Roll Id <a href="?sort=asc">&#9650;</a>
        <a href="?sort=desc">&#9660;</a></th>
                <th>Document Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $directory = "letters/completion_letters/";
        $fileDetailsPath = $directory . "completion_letters_details.txt";

        function getRollId($details)
{
    return str_replace("Username: ", "", explode(" | ", $details)[0]);
}

        if (file_exists($fileDetailsPath)) {
            $fileDetails = file($fileDetailsPath, FILE_IGNORE_NEW_LINES);
            if (!empty($fileDetails)) {
        
                // Sorting functionality for RollId column
                if (isset($_GET['sort']) && $_GET['sort'] == 'asc') {
                    usort($fileDetails, function ($a, $b) {
                        $usernameA = getRollId($a);
                        $usernameB = getRollId($b);
                        return strcmp($usernameA, $usernameB);
                    });
                }
        
                // Searching functionality for RollId column
                if (isset($_GET['search'])) {
                    $searchTerm = $_GET['search'];
                    $fileDetails = array_filter($fileDetails, function ($details) use ($searchTerm) {
                        $rollId = getRollId($details);
                        return stripos($rollId, $searchTerm) !== false && stripos($rollId, $searchTerm) === 0;
                    });
                }
        
                foreach ($fileDetails as $details) {
                    $splitDetails = explode(" | ", $details);
                    $username = str_replace("Username: ", "", $splitDetails[0]);
                    $fileName = str_replace("File: ", "", $splitDetails[1]);
        
                    echo '<tr>' . PHP_EOL;
                    echo '<td>' . $username . '</td>' . PHP_EOL;
                    echo '<td>' . $fileName . '</td>' . PHP_EOL;
                    echo '<td><a href="' . $directory . $fileName . '" class="open-tab-btn" target="_blank">View</a></td>' . PHP_EOL;
                    echo '</tr>' . PHP_EOL;
                }
            } else {
                echo '<tr><td colspan="3">The "completion_letters_details.txt" file exists, but it is empty.</td></tr>';
            }
        } else {
            echo '<tr><td colspan="3">No completion letters received yet.</td></tr>';
        }
        ?>
</body>
</html>
