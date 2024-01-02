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
        position: sticky;
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

    td a {
        color: #4CAF50;
        text-decoration: none;
    }

    td a:hover {
        text-decoration: underline;
    }

    form {
    margin: 20px;
    padding: 10px;
    width: 180vh;
    height: max-content;
    background-color: #f5f7fa;
    border: 1px solid #c3cfe2;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    form h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    form .form-group {
        margin-bottom: 15px;
    }

    form label {
        display: block;
        margin-bottom: 5px;
    }

    form input {
        width: 90%;
        padding: 10px;
        font-size: 16px;
    }

    .delete-button {
            background-color: #f44336;
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
    }

    @media screen and (max-width: 770px) {
        .navbar ul {
            flex-direction: row;
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

    <form method="POST" action="add_company.php" style=" background-color: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); display: grid; grid-auto-flow:row;">
    <h2>Add New Company</h2>
    <div>
    <div class="form-group" style="display: inline-block; margin-right: 10px; margin-left: 60px">
        <label for="company_name">Company Name:</label>
        <input type="text" id="company_name" name="company_name" required>
    </div>
    <div class="form-group" style="display: inline-block; margin-right: 10px;">
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>
    </div>
    <div class="form-group" style="display: inline-block; margin-right: 10px;">
        <label for="hr_name">HR Name:</label>
        <input type="text" id="hr_name" name="hr_name" required>
    </div>
    <div class="form-group" style="display: inline-block; margin-right: 10px;">
        <label for="hr_phone">HR Phone:</label>
        <input type="text" id="hr_phone" name="hr_phone" required>
    </div>
    <div class="form-group" style="display: inline-block; margin-right: 10px;">
        <label for="hr_email">HR Email:</label>
        <input type="email" id="hr_email" name="hr_email" required>
    </div>
    <input type="submit" value="Add Company" style="width: 50%; margin: 0vh 40vh;">
    </div>
</form>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Company Name <a href="?sort=asc&amp;column=Company%20Name">&#9650;</a>
            <a href="?sort=desc&amp;column=Company%20Name">&#9660;</a></th>
                    <th>Location</th>
                    <th>HR Name</th>
                    <th>HR Phone</th>
                    <th>HR Email</th>
                    <th>Action</th>
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

                $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
                $column = isset($_GET['column']) ? $_GET['column'] : '';

                // Fetch data from company_list table
                $sql = "SELECT * FROM company_list_trial";
                if (!empty($sort) && !empty($column)) {
                    $sql .= " ORDER BY " . $column . " ";
                    $sql .= ($sort == 'asc') ? "ASC" : "DESC";
                }
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
                        // Add other columns as needed

                        // Example of adding a delete button (modify with proper functionality)
                        echo "<td><a href='delete_company.php?id=" . $row["Company Name"] . "' class='delete-button'>Delete</a></td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>