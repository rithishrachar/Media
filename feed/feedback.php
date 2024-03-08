<?php
// Retrieve form inputs
$satisfaction = $_POST['view'];
$comments = $_POST['comments'];
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['num'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nk";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into the database
$sql = "INSERT INTO poll (suggestions, feedback, name, email, phone) VALUES ('$satisfaction', '$comments', '$name', '$email', '$number')";

if ($conn->query($sql) === TRUE) {
    // Display alert message and redirect
    echo '<script>alert("Thank You..! Your Feedback is Valuable to Us"); window.location.href = "../Service/bookingx.php";</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
