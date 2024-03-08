<?php
// Assuming you have already established a database connection
$hostname = "localhost";  // Replace with your hostname
$username = "root";  // Replace with your username
$password = "";  // Replace with your password
$database = "nk";  // Replace with your database name

// Create a connection
$connection = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emp_id = $_POST['emp_id'];
    $emp_name = $_POST['emp_name'];
    $leave_reason = $_POST['leave_reason'];
    $leave_start_date = $_POST['leave_start_date'];
    $leave_end_date = $_POST['leave_end_date'];

    // Check if the employee exists in the employee table
    $check_query = "SELECT * FROM employee WHERE id = '$emp_id'";
    $result = mysqli_query($connection, $check_query);

    if (mysqli_num_rows($result) == 0) {
        echo '<div style="background-color: #FF0000; color: #fff; padding: 50px; text-align: center;">Employee not found.</div>';
    } else {
        // Insert the leave request into the employee_leaves table
        $sql = "INSERT INTO employee_leaves (emp_id, emp_name, leave_reason, leave_start_date, leave_end_date) VALUES ('$emp_id', '$emp_name', '$leave_reason', '$leave_start_date', '$leave_end_date')";

        if (mysqli_query($connection, $sql)) {
            echo '<div style="background-color: #FF0000; color: #fff; padding: 50px; text-align: center;">Leave request submitted successfully. Redirecting...</div>';
            header("refresh:3; url=http://localhost/newskarkala/emp/leavestatus.php"); // Redirect to success page after 3 seconds  
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }
    }

    mysqli_close($connection);
}
?>
