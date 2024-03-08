<html>
    <body>
        <style>
            /* Reset Styles */
            body {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
            }

            /* Page Styles */
            body {
                background-color: #f1f1f1;
            }

            h1 {
                background-color: #333;
                color: #fff;
                padding: 20px;
                margin: 0;
                text-align: center;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            th {
                background-color: #333;
                color: #fff;
            }

            /* Vertical Line Between Columns */
            td:not(:last-child) {
                position: relative;
            }

            td:not(:last-child)::after {
                content: "";
                position: absolute;
                top: 0;
                right: 0;
                height: 100%;
                border-right: 1px solid #ddd;
            }

            /* Responsive Styles */
            @media screen and (max-width: 600px) {
                h1 {
                    font-size: 24px;
                }
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
    <style>
  /* CSS for the navigation bar and table */
  /* ...existing CSS code... */
  
  /* CSS for the calendar */
  .calendar {
    display: inline-block;
    margin-bottom: 10px;
  }

  .calendar input {
    padding: 6px 40px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    background-color: bisque;
  }
</style>

<script>
  // JavaScript code for handling date selection
  document.addEventListener('DOMContentLoaded', function() {
    var calendarInput = document.getElementById('calendar-input');

    calendarInput.addEventListener('change', function() {
      var selectedDate = calendarInput.value;
      var bookingRows = document.querySelectorAll('.booking-row');
      
      bookingRows.forEach(function(row) {
        var eventDate = row.getAttribute('data-event-date');
        
        if (eventDate === selectedDate) {
          row.style.display = 'table-row';
        } else {
          row.style.display = 'none';
        }
      });
    });
  });
</script>
    <div class="navbar">
  <a class="active" href="dashboard2.php">HOME</a>
  <a href="../logout.php">LOGOUT</a>
  <!-- <a href="#">Contact</a> -->
</div>
<div class="calendar">
  <input type="date" id="calendar-input">
</div>

    </body>
</html>
<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['employee_id'])) {
    echo "You are not logged in.";
    exit;
}

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
  $sql = "UPDATE youtube SET work_status = '$status' WHERE sno = $sno";

  $result = mysqli_query($conn, $sql);

  if ($result) {
      // echo "Work status updated successfully.";
      echo '<div style="background-color: #FF0000; color: #fff; padding: 50px; text-align: center;">Work status updated successfully Redirecting...</div>';
      header("refresh:3; url=http://localhost/newskarkala/emp/viewtask.php"); // Redirect to success page after 5 seconds  
  } else {
      echo "Error updating work status: " . mysqli_error($conn);
  }
}
// Check if filter form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['filter_work_status'])) {
    $workStatus = $_POST['filter_work_status'];

    // Retrieve tasks for employee with matching work status
    $sql = "SELECT task.task_id, task.sno, task.name1, task.email1, task.ev_date, task.ev_name, task.employee_number, task.number, task.address, task.pincode, youtube.work_status
        FROM task
        INNER JOIN youtube ON task.sno = youtube.sno
        WHERE task.employee_number = '".$_SESSION['employee_id']."' AND youtube.work_status = '$workStatus'";
} else {
    // Retrieve all tasks for employees
    $sql = "SELECT task.task_id, task.sno, task.name1, task.email1, task.ev_date, task.ev_name, task.employee_number, task.number, task.address, task.pincode, youtube.work_status
        FROM task
        INNER JOIN youtube ON task.sno = youtube.sno
        WHERE task.employee_number = '".$_SESSION['employee_id']."'";
}

$result = mysqli_query($conn, $sql);

// Rest of the code remains the same


if ($result) { // Check if the query executed successfully
    if (mysqli_num_rows($result) > 0) {
        // Output data in table format
        echo "<center><h1><u>YOUTUBE STREAMING</u></h1></center>";
        // echo '<form action="viewtask.php" method="post">';
        // echo '    <label for="filter_work_status">Filter by Work Status:</label>';
        // echo '    <select name="filter_work_status">';
        // echo '        <option value="">All</option>';
        // echo '        <option value="Pending">Pending</option>';
        // echo '        <option value="Complete">Complete</option>';
        // echo '        <option value="In Progress">In Progress</option>';
        // echo '        <option value="Cancelled">Cancelled</option>';
        // echo '    </select>';
        // echo '    <input type="submit" value="Filter">';
        // echo '</form>';
        
        echo "<table>";
        echo "<tr>";
        echo "<th>Task ID</th>";
        echo "<th>Booking ID</th>";
        echo "<th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Event Date</th>";
        echo "<th>Event Name</th>";
        echo "<th>Phone Number</th>";
        echo "<th>Address</th>";
        echo "<th>Pincode</th>";
        echo "<th>Employee Number(Task Assigned)</th>";
        echo "<th>Status</th>";
        echo "<th>Update</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<tr class='booking-row' data-event-date='" . $row["ev_date"] . "'>";

            echo "<td>" . $row['task_id'] . "</td>";
            echo "<td>" . $row['sno'] . "</td>";
            echo "<td>" . $row['name1'] . "</td>";
            echo "<td>" . $row['email1'] . "</td>";
            echo "<td>" . $row['ev_date'] . "</td>";
            echo "<td>" . $row['ev_name'] . "</td>";
            echo "<td>" . $row['number'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['pincode'] . "</td>";
            echo "<td><center>" . $row['employee_number'] . "</center></td>";
            echo "<td>" . $row['work_status'] . "</td>";
            echo "<td>";
            echo "<form action='viewtask.php' method='post'>"; // Use a separate PHP file to handle status update
            echo "<input type='hidden' name='id' value='" . $row['sno'] . "'>";
            echo "<select name='status'>";
            echo "<option value='Pending' " . ($row['work_status'] == 'Pending' ? "selected" : "") . ">Pending</option>";
            echo "<option value='Complete' " . ($row['work_status'] == 'Complete' ? "selected" : "") . ">Complete</option>";
            echo "<option value='In Progress' " . ($row['work_status'] == 'In Progress' ? "selected" : "") . ">In Progress</option>";
            echo "<option value='Cancelled' " . ($row['work_status'] == 'Cancelled' ? "selected" : "") . ">Cancelled</option>";
            echo "</select>";
            echo "<input type='submit' value='Update' class='status-button'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        // Display message if no tasks are assigned
        echo "No tasks assigned to you.";
    }
} else {
    // Query execution failed
    echo "Error executing query: " . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>
<html>
    <body>
        <!-- CSS and navigation bar code goes here -->

<div id="message"></div>
<div id="loginLink" style="display: none;"><a href="../login/login_form.php">Login</a></div>

    </body>
</html>