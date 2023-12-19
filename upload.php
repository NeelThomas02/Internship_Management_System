<?php
function displayExcelData($targetFile) {
    // Load the uploaded Excel file using PhpSpreadsheet
    require 'vendor/autoload.php'; // Adjust the path as needed
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetFile);

    // Get the first worksheet
    $worksheet = $spreadsheet->getActiveSheet();

    // Start building the HTML table
    echo "<table border='1'>";
    foreach ($worksheet->getRowIterator() as $row) {
        echo "<tr>";
        foreach ($row->getCellIterator() as $cell) {
            echo "<td>" . $cell->getValue() . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["company_list"]["name"]);
    $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);

    // Check file format
    if ($fileType !== "xlsx" && $fileType !== "xls") {
        echo "Only Excel files are allowed.";
    } else {
        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES["company_list"]["tmp_name"], $targetFile)) {
            // Display Excel data as a table
            displayExcelData($targetFile); // Call the function to display Excel data
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>