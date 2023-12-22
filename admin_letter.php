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

        a {
            text-decoration: none !important;
            color: white !important;
        }

        a:hover {
            color: black !important;
        }
    </style>
</head>
<body>
<div class="navbar">
    <ul>
        <li class="listitems"><a href="admin_dashboard.html">Home</a></li>
        <li class="listitems"><a href="admin_company_list.php">Company List</a></li>
        <li class="listitems"><a href="admin_letter.php">Student Documents</a></li>
        <!-- <li class="listitems"><a href="upload.html">Upload</a></li> -->
        <li class="listitems"><a href="logout.php">Logout</a></li>
    </ul>
</div>


</body>
</html>