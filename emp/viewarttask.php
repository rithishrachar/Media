<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .table-container {
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
        }

        h1 {
            text-align: center;
            padding: 20px;
            background-color: #f2f2f2;
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        /* Add vertical lines between columns */
        th:not(:last-child),
        td:not(:last-child) {
            border-right: 1px solid #ddd;
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
        .status-button {
    background-color: green;
    color: white;
  }
    </style>
    <div class="navbar">
        <a class="active" href="dashboard2.php">HOME</a>
        <a href="../logout.php">LOGOUT</a>
    </div>
</head>
<body>
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['employee_id'])) {
    echo "You are not logged in.";
    exit;
}

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nk";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$employeeID = $_SESSION['employee_id'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['status'])) {
    // Retrieve the task ID and status from the form
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Update the work_status in the articals table
    $updateQuery = $conn->prepare("UPDATE articals SET work_status = ? WHERE sno = ?");
    $updateQuery->bind_param("si", $status, $id);
    if ($updateQuery->execute()) {
        // Update successful
        echo '<div style="background-color: #FF0000; color: #fff; padding: 50px; text-align: center;">Work status updated successfully Redirecting...</div>';
        header("refresh:3; url=http://localhost/newskarkala/emp/viewarttask.php"); // Redirect to success page after 5 seconds
    } else {
        // Update failed
        echo "Error updating work status: " . $updateQuery->error;
    }
}

// Check if the filter form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['filter_work_status'])) {
    $workStatus = $_POST['filter_work_status'];

    // Retrieve rows with matching work status
    $sql = "SELECT task.*, articals.work_status 
            FROM task 
            INNER JOIN articals ON task.sno = articals.sno 
            WHERE task.task_type = 'artical' AND articals.work_status = '$workStatus'";
} else {
    // Retrieve all rows with task_type = "artical"
    $sql = "SELECT task.*, articals.work_status 
            FROM task 
            INNER JOIN articals ON task.sno = articals.sno 
            WHERE task.task_type = 'artical'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>ARTICLE TASKS</h1>";
    echo "<form action='viewarttask.php' method='post'>";
    echo "<label for='filter_work_status'>Filter by Work Status:</label>";
    echo "<select name='filter_work_status'>";
    echo "<option value='Pending'>Pending</option>";
    echo "<option value='Complete'>Complete</option>";
    echo "<option value='In Progress'>In Progress</option>";
    echo "<option value='Cancelled'>Cancelled</option>";
    echo "</select>";
    echo "<input type='submit' value='Filter'>";
    echo "</form>";
    echo "<table>";
    echo "<tr><th>Task ID</th><th>Booking NO</th><th>Name</th><th>Email</th><th>Number</th><th>Article Title</th><th>Article</th><th>File</th><th>Employee Number (Task Assigned)</th><th>Work Status</th><th>Update</th>";

    while ($row = $result->fetch_assoc()) {
        if ($row['employee_number'] == $employeeID) {
            echo "<tr>";
            echo "<td>" . $row['task_id'] . "</td>";
            echo "<td>" . $row['sno'] . "</td>";
            echo "<td>" . $row['name1'] . "</td>";
            echo "<td>" . $row['email1'] . "</td>";
            echo "<td>" . $row['number'] . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['artical'] . "</td>";
            echo "<td><a href='../Service/artfiles/" . $row['file'] . "' download>" . $row['file'] . "</a></td>";
            echo "<td><center>" . $row['employee_number'] . "</center></td>";
            // echo "<td>" . $row['task_status'] . "</td>";
            echo "<td>" . $row['work_status'] . "</td>";
            echo "<td>";
            echo "<form action='' method='post'>";
            echo "<input type='hidden' name='id' value='" . $row['sno'] . "'>";
            echo "<select name='status'>";
            echo "<option value='Pending' " . ($row['task_status'] == 'Pending' ? 'selected' : '') . ">Pending</option>";
            echo "<option value='Complete' " . ($row['task_status'] == 'Complete' ? 'selected' : '') . ">Complete</option>";
            echo "<option value='In Progress' " . ($row['task_status'] == 'In Progress' ? 'selected' : '') . ">In Progress</option>";
            echo "<option value='Cancelled' " . ($row['task_status'] == 'Cancelled' ? 'selected' : '') . ">Cancelled</option>";
            echo "</select>";
            echo "<input type='submit' value='Update' class='status-button'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
} else {
    echo "<h1>No Article tasks</h1>";
}

// Close the database connection
$conn->close();

?>
</body>
</html>
