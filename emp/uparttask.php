<?php
session_start();

// Check if user is logged in
/* if (!isset($_SESSION["email"])) {
    echo "You are not logged in.";
    exit;
}
 */
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sno = $_POST["id"];
    $status = $_POST["status"];

    // Update the work status in the database
    $sql = "UPDATE articals SET work_status = '$status' WHERE sno = $sno";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        // echo "Work status updated successfully.";
        echo '<div style="background-color: #FF0000; color: #fff; padding: 50px; text-align: center;">Work status updated successfully Redirecting...</div>';
        header("refresh:3; url=http://localhost/newskarkala/emp/viewarttask.php"); // Redirect to success page after 5 seconds  
    } else {
        echo "Error updating work status: " . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
?>
