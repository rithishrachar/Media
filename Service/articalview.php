
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

th {
  background-color: #00407f;
  color: white;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

tr:hover {
  background-color: #ddd;
}

td:not(:last-child),
th:not(:last-child) {
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
<div class="navbar">
  <a class="active" href="../admin/dashboard.php">HOME</a>
  <a href="../admin/viewemp.php">EMPLOYEE DETAILS</a>
  <a href="../logout.php">LOGOUT</a>
  <!-- <a href="#">Contact</a> -->
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
    header("refresh:3; url=http://localhost/newskarkala/Service/articalview.php"); // Redirect to success page after 5 seconds
  } else {
    echo "Error Deleting task data: " . $conn->error . " Redirecting...";
    header("refresh:3; url=http://localhost/newskarkala/Service/articalview.php"); // Redirect to error page after 5 seconds
  }
}

// Check if delete button is clicked
if (isset($_POST['delete1'])) {
   $id = $_POST['delete1'];
   // Delete the row from the table
   $deleteQuery = "DELETE FROM articals WHERE sno = $id";
   if (mysqli_query($conn, $deleteQuery)) {
      echo '<div style="background-color: #FF0000; color: #fff; padding: 50px; text-align: center;">Article Deleted successfully. Redirecting...</div>';
      header("refresh:3; url=http://localhost/newskarkala/Service/articalview.php"); // Redirect to success page after 5 seconds
   } else {
      echo "Error Deleting Article data: " . $conn->error . " Redirecting...";
      header("refresh:3; url=http://localhost/newskarkala/Service/articalview.php"); // Redirect to error page after 5 seconds
   }
}




// Retrieve booking requests from database
$filter = isset($_POST['filter_work_status']) ? $_POST['filter_work_status'] : '';
$filterQuery = $filter !== '' ? "WHERE work_status = '$filter'" : '';
$sql = "SELECT * FROM articals $filterQuery";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Output data in a table
    echo "<center><h1>ARTICLE</h1></center>";
    echo "<form action='articalview.php' method='post'>";
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
    echo "<tr><th>SNO</th><th>Name</th><th>Email</th><th>Phone Number</th><th>Title</th><th>Article</th><th>File</th><th>Task Status</th><th>Assigned To</th><th>Emp ID</th><th>Delete Task</th><th>Delete Article</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["sno"] . "</td>";
        echo "<td>" . $row["name3"] . "</td>";
        echo "<td>" . $row["email3"] . "</td>";
        echo "<td>" . $row["number"] . "</td>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["artical"] . "</td>";
        echo "<td><a href='artfiles/" . $row["file"] . "' download>" . $row["file"] . "</a></td>";
        echo "<td>".$row['work_status']."</td>";
        echo "<td>".$row['emp_id']."</td>";
        echo "<td>";
        echo "<form action='../admin/artassign_task.php' method='post'>";
        echo "<input type='hidden' name='id' value='" . $row["sno"] . "'>";
        echo "<input type='text' name='employee_number'>";
        echo "<input type='submit' value='Assign Task' class='assign-button'>";
        echo "</form>";
        echo "</td>";
        echo "<td>";
        echo "<form action='articalview.php' method='post'>";
        echo "<input type='hidden' name='delete' value='" . $row["sno"] . "'>";
        echo "<input type='submit' value='Delete Task' class='red-button'>";
        echo "</form>";
        echo "</td>";
        echo "<td>";
      echo "<form action='articalview.php' method='post'>";
      echo "<input type='hidden' name='delete1' value='" . $row["sno"] . "'>";
      echo "<input type='submit' value='Delete Article' class='booking-button'>";
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
