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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('form').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            // Get form data
            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: 'submit.php',
                data: formData,
                success: function(response) {
                    // Display toast notification on success
                    showToast("New record created successfully");
                },
                error: function() {
                    // Handle errors if needed
                }
            });
        });

        function showToast(message) {
            // Replace this with your preferred method of displaying a toast notification
            alert(message); // For demonstration, using alert as a placeholder
        }
    });
</script>

</head>
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
    <?php
// session_start();

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
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="input-container">
            <label for="fullName">Full Name</label>
            <input type="text" id="fullName" name="fullName" required>
        </div>
        <!-- <div class="input-container">
            <label for="branch">Branch</label>
            <input type="text" id="branch" name="branch" required>
        </div> -->
        <div class="input-container">
            <label for="branch">Department</label>
            <select id="branch" name="branch" required>
                <option value="">Select Department</option>
                <option value="CSE">CSE</option>
                <option value="CE">CE</option>
                <option value="IT">IT</option>
            </select>
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
            <label for="typeofinternship">Type of Internship</label>
            <select id="typeofinternship" name="typeofinternship" required>
                <option value="">Select type of internship</option>
                <option value="technologytraining">Technology Training</option>
                <option value="developmentproject">Development Project</option>
                <option value="inhouseinternship">Inhouse Internship</option>
                <option value="researchinternship">Research Internship</option>
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