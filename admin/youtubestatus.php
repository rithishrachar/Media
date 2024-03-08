<style>
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
  
  /* Rest of the styling */
  table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    text-align: left;
    padding: 8px;
    border-bottom: 1px solid #ddd;
  }

  th {
    background-color: aquamarine;
    color: #333;
  }

  tr:hover {
    background-color: #f5f5f5;
  }

  td:not(:last-child) {
    border-right: 1px solid #ddd;
  }

  select {
    padding: 6px 10px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    background-color: #f2f2f2;
  }

  input[type=text] {
    padding: 6px 10px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    background-color: bisque;
  }
  
  input[type=submit] {
    padding: 6px 10px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    background-color: #f2f2f2;
    background-color: dodgerblue;
  }

  input[type=submit]:hover {
    background-color: #ddd;
  }
  .red-button {
    background-color: red;
    color: white;
  }
  .assign-button {
    background-color: green;
    color: white;
  }
  .booking-button {
    background-color:firebrick;
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
  <a class="active" href="dashboard.php">HOME</a>
  <a href="viewemp.php">EMPLOYEE DETAILS</a>
  <a href="../logout.php">LOGOUT</a>
  <!-- <a href="#">Contact</a> -->
</div>
<div class="calendar">
  <input type="date" id="calendar-input">
</div>
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

// Check if delete button is clicked
if (isset($_POST['delete'])) {
  $id = $_POST['delete'];
  // Delete the row from the table
  $deleteQuery = "DELETE FROM task WHERE sno = $id";
  if (mysqli_query($conn, $deleteQuery)) {
    echo '<div style="background-color: #FF0000; color: #fff; padding: 50px; text-align: center;">Task Deleted successfully. Redirecting...</div>';
    header("refresh:3; url=http://localhost/newskarkala/admin/youtubestatus.php"); // Redirect to success page after 5 seconds
  } else {
    echo "Error Deleting task data: " . $conn->error . " Redirecting...";
    header("refresh:3; url=http://localhost/newskarkala/admin/youtubestatus.php"); // Redirect to error page after 5 seconds
  }
}

// Check if delete button is clicked
if (isset($_POST['delete1'])) {
  $id = $_POST['delete1'];
  // Delete the row from the table
  $deleteQuery = "DELETE FROM youtube WHERE sno = $id";
  if (mysqli_query($conn, $deleteQuery)) {
     echo '<div style="background-color: #FF0000; color: #fff; padding: 50px; text-align: center;">Youtube Booking Data Deleted successfully. Redirecting...</div>';
     header("refresh:3; url=http://localhost/newskarkala/admin/youtubestatus.php"); // Redirect to success page after 5 seconds
  } else {
     echo "Error Deleting Youtube Booking  data: " . $conn->error . " Redirecting...";
     header("refresh:3; url=http://localhost/newskarkala/admin/youtubestatus.php"); // Redirect to error page after 5 seconds
  }
}

// Retrieve booking requests from database
$filter = isset($_POST['filter_work_status']) ? $_POST['filter_work_status'] : '';
$filterQuery = $filter !== '' ? "WHERE work_status = '$filter'" : '';
$sql = "SELECT * FROM youtube $filterQuery";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Output data in table format
    
    echo "<center><h1 style='color: #ff0000;'>YOUTUBE SERVICE</h1></center>";
    echo "<form action='youtubestatus.php' method='post'>";
    echo "<label for='filter_work_status'>Filter by Work Status:</label>";
    echo "<select name='filter_work_status'>";
    echo "<option value=''>All</option>";
    echo "<option value='Pending'" . ($filter === 'Pending' ? " selected" : "") . ">Pending</option>";
    echo "<option value='Complete'" . ($filter === 'Complete' ? " selected" : "") . ">Complete</option>";
    echo "<option value='In Progress'" . ($filter === 'In Progress' ? " selected" : "") . ">In Progress</option>";
    echo "<option value='Cancelled'" . ($filter === 'Cancelled' ? " selected" : "") . ">Cancelled</option>";
    echo "</select>";
    echo "<input type='submit' value='Filter'>";
    echo "</form>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Booking ID</th>";
    echo "<th>Name</th>";
    echo "<th>Email</th>";
    echo "<th>Event Date</th>";
    echo "<th>Event Name</th>";
    echo "<th>Phone Number</th>";
    echo "<th>Address</th>";
    echo "<th>Pincode</th>";
    echo "<th>Work Status</th>";
    echo "<th>Status</th>";
    echo "<th>Update</th>";
    echo "<th>Assigned Emp NO</th>";
    echo "<th>Emp No</th>";
    echo"<th>Delete Task</th>";
    echo"<th>Delete Booking</th>";
    echo "</tr>";
    
    while($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<tr class='booking-row' data-event-date='" . $row["ev_date"] . "'>";

      echo "<td>" . $row["sno"] . "</td>";
      echo "<td>" . $row["name1"] . "</td>";
      echo "<td>" . $row["email1"] . "</td>";
      echo "<td>" . $row["ev_date"] . "</td>";
      echo "<td>" . $row["ev_name"] . "</td>";
      echo "<td>" . $row["number"] . "</td>";
      echo "<td>" . $row["address"] . "</td>";
      echo "<td>" . $row["pincode"] . "</td>";
      echo "<td>" . $row["work_status"] . "</td>";
      echo "<td>" . $row["status"] . "</td>";
      echo "<td>";
      echo "<form action='update_booking.php' method='post'>";
      echo "<input type='hidden' name='id' value='" . $row["sno"] . "'>";
      echo "<select name='status'>";
      echo "<option value='Pending' " . ($row["status"] == "Pending" ? "selected" : "") . ">Pending</option>";
      echo "<option value='Approved' " . ($row["status"] == "Approved" ? "selected" : "") . ">Approved</option>";
      echo "<option value='Cancelled' " . ($row["status"] == "Cancelled" ? "selected" : "") . ">Cancelled</option>";
      echo "</select>";
      echo "<input type='submit' value='Update'>";
      echo "</form>";
      echo "<td>" . $row["employee_id"] . "</td>";
      echo "</td>";
      echo "<td>";

      echo "<form action='assign_task.php' method='post'>";
      echo "<input type='hidden' name='id' value='" . $row["sno"] . "'>";
      echo "<input type='text' name='employee_number'>";
      echo "<input type='submit' value='Assign Task' class='assign-button'>";
      echo "</form>";
      echo "</td>";
      echo "<td>";
      echo "<form action='youtubestatus.php' method='post'>";
      echo "<input type='hidden' name='delete' value='" . $row["sno"] . "'>";
      echo "<input type='submit' value='Delete Task' class='red-button'>";
      echo "</form>";
      echo "</td>";
      echo "<td>";
      echo "<form action='youtubestatus.php' method='post'>";
      echo "<input type='hidden' name='delete1' value='" . $row["sno"] . "'>";
      echo "<input type='submit' value='Delete Booking' class='booking-button'>";
      echo "</form>";
      echo "</td>";
      echo "</tr>";
      
  }

    echo "</table>";
} else {
    echo "No booking requests found.";
}

// Close database connection
mysqli_close($conn);
?>