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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
$(document).ready(function() {
    $('form').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        var formData = new FormData($(this)[0]);

        $.ajax({
            type: 'POST',
            url: 'upload_letter.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Handle success, show toast message or perform any action
                showToast("Documents uploaded successfully!");
            },
            error: function() {
                // Handle errors, show toast message or perform any action
                showToast("Error uploading documents.");
            }
        });
    });

    function showToast(message) {
        // Replace this with your preferred method of displaying a toast
        alert(message); // For demonstration, using alert as a placeholder
    }
});
</script>

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

input[type="file"] {
    width: 100%;
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
            <li class="listitems"><a href="student_dashboard.php">Home</a></li>
            <li class="listitems"><a href="companylist.php">Company List</a></li>
            <li class="listitems"><a href="letter.php">Upload</a></li>
            <li class="listitems"><a href="logout.php">Logout</a></li>
            <li style="margin-left: auto; color: white;"><span><?php echo $loggedInUser; ?></span></li>
        </ul>
    </div>
    <h1>Upload Documents</h1>
    <form action="upload_letter.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="offer_letter">Offer Letter:</label>
            <input type="file" name="offer_letter" id="offer_letter" required>
        </div>
        <div class="form-group">
            <label for="completion_letter">Completion Letter:</label>
            <input type="file" name="completion_letter" id="completion_letter" >
        </div>
        <div class="form-group">
            <input type="submit" value="Upload">
        </div>
    </form>
</body>
</html>