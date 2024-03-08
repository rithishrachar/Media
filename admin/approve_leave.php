<?php
// Connect to database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "nk";

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to update leave request status
if ($_GET['action'] == 'approve') {
    $status = 'Approved';
} else if ($_GET['action'] == 'cancel') {
    $status = 'Cancelled';
}
$sql = "UPDATE employee_leaves el JOIN employee e ON el.emp_id = e.id SET el.status = ? WHERE e.id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "Error preparing statement: " . $conn->error;
    $conn->close();
    exit();
}

// Bind parameters to prepared statement
$stmt->bind_param("si", $status, $_GET['id']);

// Execute prepared statement
if ($stmt->execute()) {
    echo '<script>alert("Leave request updated successfully!"); window.location.href = "e2.php";</script>';
} else {
    echo "Error updating leave request: " . $stmt->error;
}

// Close prepared statement and database connection
$stmt->close();
$conn->close();
?>
