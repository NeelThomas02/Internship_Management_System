<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Offer Letter</title>
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
<div class="file-list">
    <table>
        <thead>
            <tr>
                <th>RollId</th>
                <th>Document Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
$directory = "letters/offer_letters/";
$fileDetailsPath = $directory . "offer_letters_details.txt";

if (file_exists($fileDetailsPath)) {
    $fileDetails = file($fileDetailsPath, FILE_IGNORE_NEW_LINES);
    if (!empty($fileDetails)) {
        foreach ($fileDetails as $details) {
            $splitDetails = explode(" | ", $details);
            $username = str_replace("Username: ", "", $splitDetails[0]);
            $fileName = str_replace("File: ", "", $splitDetails[1]);

            echo '<tr>';
            echo '<td>' . $username . '</td>';
            echo '<td>' . $fileName . '</td>';
            echo '<td><a href="' . $directory . $fileName . '" class="open-tab-btn" target="_blank">View</a></td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="2">The "offer_letters_details.txt" file exists, but it is empty.</td></tr>';
    }
} else {
    echo '<tr><td colspan="2">No offer letters received yet.</td></tr>';
}
?>
        </tbody>
    </table>
</body>
</html>
