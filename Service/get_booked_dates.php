<?php
// Replace the following code with your own logic to retrieve booked dates from the YouTube table
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'nk';

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch booked dates from the YouTube table
$sql = "SELECT ev_date FROM youtube";
$result = $conn->query($sql);

$bookedDates = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookedDates[] = $row['ev_date'];
    }
}

// Close the database connection
$conn->close();

// Send the booked dates as a JSON response
header('Content-Type: application/json');
echo json_encode($bookedDates);
?>
