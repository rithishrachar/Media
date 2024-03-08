<html>
    <head>
    <link rel="stylesheet" href="../admin/styleview.css">
    <style>
body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
  margin: 0;
  padding: 0;
}

h1 {
  text-align: center;
  color: #333;
  margin-top: 50px;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 30px;
}

table th,
table td {
  padding: 10px;
  border: 1px solid #ccc;
}

table th {
  background-color: #333;
  color: #fff;
  font-weight: bold;
}

table tr:nth-child(even) {
  background-color: #f2f2f2;
}

table tr:hover {
  background-color: #ddd;
}

/* CSS for the navigation bar */
.navbar {
    background-color: #333;
    overflow: hidden;
  }

  .navbar a {
    float: left;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
  }

  .navbar a:hover {
    background-color: #ddd;
    color: black;
  }

  .navbar a.active {
    background-color: dodgerblue;
    color: white;
  }
    </style>
    <div class="navbar">
  <a class="active" href="dashboard2.php">Home</a>
  <a href="../logout.php">LogOut</a>
  <!-- <a href="#">Contact</a> -->
</div>

        </style>
</head>
</html>
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

// Retrieve leave requests from database
$sql = "SELECT * FROM employee_leaves";
$result = mysqli_query($conn, $sql);
echo"<h1>LEAVE STATUS</h1>";
if (mysqli_num_rows($result) > 0) {
    // Output table of leave requests
    echo "<table>";
    echo "<tr><th>Employee ID</th><th>Employee Name</th><th>Leave Reason</th><th>Leave Start Date</th><th>Leave End Date</th><th>Days</th><th>Status</th></tr>";
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
        // echo "<td><a href='approve_leave.php?id=" . $row['emp_id'] . "&action=approve'>Approve</a> | <a href='approve_leave.php?id=" . $row['emp_id'] . "&action=cancel'>Cancel</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No leave requests found.";
}

// Process leave request approval/cancellation
/* if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    // Update leave request status in database
    $sql = "UPDATE employee_leaves SET status = '$action' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Leave request " . $action . "ed successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
 */
// Close database connection
mysqli_close($conn);
?>
