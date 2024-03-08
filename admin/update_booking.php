<?php
// Set up database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nk";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get input data from form
$id = $_POST['id'];
$status = $_POST['status'];

// Prepare SQL statement to update booking status
$sql = "UPDATE youtube SET status='$status' WHERE sno=$id";

// Execute SQL statement and check for errors
if (mysqli_query($conn, $sql)) {
    // Display success message and redirect to youtubestatus.php
    echo "<script>alert('Status updated successfully');window.location='youtubestatus.php';</script>";
} else {
    // Display error message
    echo "Error updating booking: " . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>
<html>
    <head>
        <link rel="stylesheet" href="styleview.css">
    </head>
</html>