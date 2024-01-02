<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        overflow-x: hidden;
        background-color: #E8F7FE;
        margin: 0;
        padding: 0;
    }

    .navbar{
        z-index: 100;
        position: fixed;
        margin-top: -2.5vh ;
        padding: 0;
        width: 100%;
    }

    ul{
        list-style: none;
        display: flex;
        background-color: #1a5ca1;
        height: 5vh;
        align-items: center;
        padding-left: 2vh;
        width: 100%;
    }

    ul li{
        padding-right: 10vh;
    }

    a{
        text-decoration: none !important;
        color: white !important;
    }

    a:hover{
        color: black !important;
    }

    h1 {
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
}

    h2 {
        text-align: center;
        margin-top: 0;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    input[type="submit"] {
        margin-top: 15px;
    }

input[type="file"] {
    width: 70%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

        .table-container {
            overflow-x: auto; /* Enable horizontal scroll */
            overflow-y: hidden;
            max-width: 100%; /* Adjust the maximum width as needed */
            margin-bottom: 20px; /* Space between the table and other content */
            margin-top: 20px; /* Space between the table and the navbar */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* Ensure uniform column width */
        }

        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
            white-space: nowrap; /* Prevent text wrapping */
            overflow: hidden;
            text-overflow: ellipsis; /* Show ellipsis for long text */
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
<body>
    <div class="navbar">
        <ul>
            <li class="listitems"><a href="admin_dashboard.php">Home</a></li>
            <li class="listitems"><a href="admin_company_list.php">Company List</a></li>
        <li class="listitems"><a href="admin_offer_letter.php">Student Offer Letter</a></li>
        <li class="listitems"><a href="admin_completion_letter.php">Student Completion Letter</a></li>
            <!-- <li class="listitems"><a href="upload.html">Upload</a></li> -->
            <li class="listitems"><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <!-- <div class="container"> -->
        <h2>Upload and Display Company List</h2>
        <form action="admin_company_list.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="company_list">Company List:</label>
                <input type="file" name="company_list" id="company_list" accept=".xlsx, .xls" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Upload">
            </div>
        </form>

        <h2>Uploaded Company List</h2>
        <div class="table-container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require 'upload.php';
            if (function_exists('displayExcelData')) {
                $targetDir = "uploads/";
                $targetFile = $targetDir . basename($_FILES["company_list"]["name"]);
                displayExcelData($targetFile); // Call the function to display Excel data
            } else {
                echo "Function displayExcelData not found.";
            }
        }
        ?>
        </div>
    <!-- </div> -->
</body>
</html>