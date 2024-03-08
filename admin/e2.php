<?php
// Connect to database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "nk";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process delete request
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the corresponding row from the database
    $sql = "DELETE FROM employee_leaves WHERE emp_id = '$id'";
    if (mysqli_query($conn, $sql)) {
        // echo "Leave request deleted successfully!";
        echo '<div style="background-color: #FF0000; color: #fff; padding: 50px; text-align: center;">Leave request deleted successfully! Redirecting...</div>';
    header("refresh:3; url=http://localhost/newskarkala/admin/e2.php"); // Redirect to success page after 5 seconds  
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Retrieve leave requests from database
$sql = "SELECT * FROM employee_leaves";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Output table of leave requests with cool CSS
    echo "<center><h1 style='color: #ff0000;'>LEAVE APPLICATIONS</h1></center>";

    echo "<table class='cool-table'>";
    echo "<tr><th>Employee ID</th><th>Employee Name</th><th>Leave Reason</th><th>Leave Start Date</th><th>Leave End Date</th><th>Leave Days</th><th>Status</th><th>Action</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['emp_id'] . "</td>";
        echo "<td>" . $row['emp_name'] . "</td>";
        echo "<td>" . $row['leave_reason'] . "</td>";
        echo "<td>" . $row['leave_start_date'] . "</td>";
        echo "<td>" . $row['leave_end_date'] . "</td>";

        // Calculate leave days
        $start = new DateTime($row['leave_start_date']);
        $end = new DateTime($row['leave_end_date']);
        $days = $end->diff($start)->days + 1;
        echo "<td>" . $days . "</td>";

        echo "<td>" . $row['status'] . "</td>";
        echo "<td><a href='approve_leave.php?id=" . $row['emp_id'] . "&action=approve'>Approve</a> | <a href='approve_leave.php?id=" . $row['emp_id'] . "&action=cancel'>Cancel</a> | <a href='?id=" . $row['emp_id'] . "&action=delete'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No leave requests found.";
}

// Close database connection
mysqli_close($conn);
?>
<html>
<head>
    <title>View Employee | Admin Panel</title>
    <style>
        /* Define cool-table CSS class */
        .cool-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
            font-family: Arial, sans-serif;
        }

        .cool-table th,
        .cool-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .cool-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .cool-table tr:hover {
            background-color: #f5f5f5;
        }

        .cool-table td:not(:last-child) {
            border-right: 1px solid #ddd;
        }
    </style>
</head>
<body>
