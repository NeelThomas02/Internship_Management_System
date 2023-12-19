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

</style>
<body>
    <div class="navbar">
        <ul>
            <li class="listitems"><a href="student_dashboard.html">Home</a></li>
            <li class="listitems"><a href="companylist.html">Company List</a></li>
            <li class="listitems"><a href="upload.html">Upload</a></li>
            <li class="listitems"><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="container">
    <h2>Company List</h2>
    <?php
    $targetDir = "uploads/";
    $files = glob($targetDir . '*.xlsx');

    if (!empty($files)) {
        $latestFile = max($files);

        require 'vendor/autoload.php';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($latestFile);
        $worksheet = $spreadsheet->getActiveSheet();

        echo "<table border='1'>";
        foreach ($worksheet->getRowIterator() as $row) {
            echo "<tr>";
            foreach ($row->getCellIterator() as $cell) {
                echo "<td>" . $cell->getValue() . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No uploaded Excel files found.";
    }
    ?>
</div>
</body>
</html>