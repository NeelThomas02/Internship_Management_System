<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Directory where the files will be stored
    $targetDirectory = "letters/";

    // Handling offer letter upload
    if (!empty($_FILES["offer_letter"]["name"])) {
        $offerLetterName = basename($_FILES["offer_letter"]["name"]);
        $targetOffer = $targetDirectory . "offer_letters/" . $offerLetterName;

        if (move_uploaded_file($_FILES["offer_letter"]["tmp_name"], $targetOffer)) {
            $offerUploadSuccess = true;
        } else {
            $offerUploadSuccess = false;
        }
    }

    // Handling completion letter upload
    if (!empty($_FILES["completion_letter"]["name"])) {
        $completionLetterName = basename($_FILES["completion_letter"]["name"]);
        $targetCompletion = $targetDirectory . "completion_letters/" . $completionLetterName;

        if (move_uploaded_file($_FILES["completion_letter"]["tmp_name"], $targetCompletion)) {
            $completionUploadSuccess = true;
        } else {
            $completionUploadSuccess = false;
        }
    }
}

// JavaScript for displaying toast messages
?>
<script>
    // Function to display a toast message
    function showToast(message) {
        // Replace this with your preferred method of displaying a toast
        alert(message); // For demonstration, using alert as a placeholder
    }

    // Check if file upload was successful and display toast accordingly
    <?php if (isset($offerUploadSuccess) && $offerUploadSuccess): ?>
        showToast("Offer Letter uploaded successfully.");
    <?php endif; ?>

    <?php if (isset($completionUploadSuccess) && $completionUploadSuccess): ?>
        showToast("Completion Letter uploaded successfully.");
    <?php endif; ?>
</script>
