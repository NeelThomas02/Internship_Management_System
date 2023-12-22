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
<h1>Uploaded Offer Letters</h1>
<div class="file-list">
    <table>
        <thead>
            <tr>
                <th>Document Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $directory = "letters/offer_letters/";
            $files = scandir($directory);

            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    echo '<tr>';
                    echo '<td>' . $file . '</td>';
                    echo '<td><a href="' . $directory . $file . '" class="open-tab-btn" target="_blank">View</a></td>';
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>
</body>
</html>
