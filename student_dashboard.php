<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Application Form</title>
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

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.card {
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

h1 {
    text-align: center;
    color: #333;
}

.input-container {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #666;
}

input[type="text"],
input[type="email"],
input[type="tel"],
textarea,
select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    box-sizing: border-box;
    font-size: 14px;
    color: #333;
}

button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 10px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
}

button[type="submit"]:hover {
    background-color: #45a049;
}
    </style>
</head>
<body>
    <div class="navbar">
        <ul>
            <li class="listitems"><a href="student_dashboard.php">Home</a></li>
            <li class="listitems"><a href="companylist.php">Company List</a></li>
            <li class="listitems"><a href="upload.html">Upload</a></li>
            <li class="listitems"><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <?php
session_start();

// Check if the message session variable exists and display it
if (isset($_SESSION['message'])) {
    echo '<div class="message">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']); // Clear the message after displaying
}
?>
    <div class="container">
        <div class="card">
        <h1 class="text-center mb-4">Online Training Form</h1>
    <form action="submit.php" method="post" enctype="multipart/form-data">
        <div class="input-container">
            <label for="studentId">Student Id</label>
            <input type="text" id="studentId" name="studentId" required>
        </div>
        <div class="input-container">
            <label for="fullName">Full Name</label>
            <input type="text" id="fullName" name="fullName" required>
        </div>
        <div class="input-container">
            <label for="branch">Branch</label>
            <input type="text" id="branch" name="branch" required>
        </div>
        <div class="input-container">
            <label for="semester">Semester</label>
            <select id="semester" name="semester" required>
                <option value="">Select Semester</option>
                <option value="3">3</option>
                <option value="6">6</option>
            </select>
        </div>
        <div class="input-container">
            <label for="learningMode">Learning Mode</label>
            <select id="learningMode" name="learningMode" required>
                <option value="">Select Learning Mode</option>
                <option value="Online">Online</option>
                <option value="Hybrid">Hybrid</option>
                <option value="On-Site">On-Site</option>
            </select>
        </div>
        <div class="input-container">
            <label for="companyName">Company Name</label>
            <input type="text" id="companyName" name="companyName" required>
        </div>
        <div class="input-container">
            <label for="confirmedTechnology">Confirmed Technology</label>
            <input type="text" id="confirmedTechnology" name="confirmedTechnology" required>
        </div>
        <div class="input-container">
            <label for="companyCity">Company City</label>
            <input type="text" id="companyCity" name="companyCity" required>
        </div>
        <div class="input-container">
            <label for="companyAddress">Company Address</label>
            <textarea id="companyAddress" name="companyAddress" rows="4" required></textarea>
        </div>
        <div class="input-container">
            <label for="companyWebsite">Company Website</label>
            <input type="text" id="companyWebsite" name="companyWebsite" required>
        </div>
        <div class="input-container">
            <label for="hrName">HR Name</label>
            <input type="text" id="hrName" name="hrName" required>
        </div>
        <div class="input-container">
            <label for="hrEmail">HR Email</label>
            <input type="email" id="hrEmail" name="hrEmail" required>
        </div>
        <div class="input-container">
            <label for="hrContact">HR Contact</label>
            <input type="tel" id="hrContact" name="hrContact" required>
        </div>
        <button type="submit">Submit</button>
    </form>
</div>
</div>
</body>
</html>