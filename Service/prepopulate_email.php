<?php
// fetch_user_details.php

// Start the session
session_start();

// Check if the user is logged in and the necessary session data is available
if (isset($_SESSION['user_name']) && isset($_SESSION['user_email'])) {
    // Retrieve the user details from the session
    $userDetails = array(
        'name' => $_SESSION['user_name'],
        'email' => $_SESSION['user_email']
    );

    // Send the user details as a JSON response
    header('Content-Type: application/json');
    echo json_encode($userDetails);
} else {
    // If the user is not logged in or session data is missing, send an empty response
    echo '';
}
?>