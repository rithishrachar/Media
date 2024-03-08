<!DOCTYPE html>
<ht>
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
            text-align:center;
            padding: 20px;
            background-color: #f2f2f2;
            margin: 0;
            font-size: 24px;
            color: #333;
         width: 147%;
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
    width: 150%;
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
    <style>
        /* CSS styles for the table and other elements */
        /* ...existing CSS code... */
        
        /* CSS for the calendar */
        .calendar {
            display: inline-block;
            margin-bottom: 10px;
        }

        .calendar input {
            padding: 6px 10px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            background-color: bisque;
        }
    </style>
    <div class="navbar">
  <a class="active" href="../admin/dashboard.php">HOME</a>
  <a href="../admin/viewemp.php">EMPLOYEE DETAILS</a>
  <a href="../logout.php">LOGOUT</a>
  <!-- <a href="#">Contact</a> -->
</div>

</head>
<body>
<div class="calendar">
        <input type="date" id="calendar-input">
    </div>
<?php

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nk";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if delete button is clicked
if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    // Delete the row from the table
    $deleteQuery = "DELETE FROM task WHERE sno = $id";
    if (mysqli_query($conn, $deleteQuery)) {
      echo '<div style="background-color: #FF0000; color: #fff; padding: 50px; text-align: center;">Task Deleted successfully. Redirecting...</div>';
      header("refresh:3; url=http://localhost/newskarkala/Service/viewad.php"); // Redirect to success page after 5 seconds
    } else {
      echo "Error Deleting task data: " . $conn->error . " Redirecting...";
      header("refresh:3; url=http://localhost/newskarkala/Service/viewad.php"); // Redirect to error page after 5 seconds
    }
  }

  // Check if delete button is clicked
if (isset($_POST['delete1'])) {
    $id = $_POST['delete1'];
    // Delete the row from the table
    $deleteQuery = "DELETE FROM advertisements WHERE no = $id";
    if (mysqli_query($conn, $deleteQuery)) {
       echo '<div style="background-color: #FF0000; color: #fff; padding: 50px; text-align: center;">Youtube Booking Data Deleted successfully. Redirecting...</div>';
       header("refresh:3; url=http://localhost/newskarkala/Service/viewad.php"); // Redirect to success page after 5 seconds
    } else {
       echo "Error Deleting Youtube Booking  data: " . $conn->error . " Redirecting...";
       header("refresh:3; url=http://localhost/newskarkala/Service/viewad.php"); // Redirect to error page after 5 seconds
    }
  }

echo"<center><h1>ADVERTISEMENTS</h1></center>";
// Retrieve all advertisement details
// Retrieve all advertisement details
$filter = isset($_POST['filter_work_status']) ? $_POST['filter_work_status'] : ''; // Get the selected filter value
// Retrieve all advertisement details
$sql = "SELECT * FROM advertisements";
if (!empty($filter)) {
    $sql .= " WHERE work_status = '$filter'";
}
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output table header
    echo "<form action='viewad.php' method='post'>";
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
    echo "<tr><th>NO</th><th>Name</th><th>Email</th><th>Number</th><th>Advertisement Type</th><th>Details</th><th>File</th><th>Duration</th><th>Amount</th><th>Payment Mode</th><th>Booking Time</th><th>Expiry Date</th><th>Remaining Days</th><th>Invoice Number</th><th>Card Number</th><th>Payment Status</th><th>Invoice</th><th>Task Status</th><th>Assigned To</th><th>Emp ID</th><th>Delete Task</th><th>Delete Advertisement</th></tr>";

    // Output each advertisement row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        
        echo "<td>".$row['no']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['number']."</td>";
        echo "<td>".$row['title']."</td>";
        echo "<td>".$row['artical']."</td>";
        echo "<td><a href='adfiles/" . $row["file"] . "' download>" . $row["file"] . "</a></td>";
        echo "<td>".$row['duration']."</td>";
        echo "<td>".$row['amount']."</td>";
        echo "<td>".$row['payment_mode']."</td>";
        echo "<td>".$row['created_at']."</td>";
        echo "<td class='expiry-date'>".$row['expiry_date']."</td>";
        echo "<td>".$row['remaining_days']."</td>";
        echo "<td>".$row['invoice_number']."</td>";
             // Fetch card number with matching invoice number from card_details table
$invoiceNumber = $row['invoice_number'];
$cardQuery = "SELECT card_number FROM card_details WHERE invoice_number = '$invoiceNumber'";
$cardResult = $conn->query($cardQuery);
if ($cardResult->num_rows > 0) {
    $cardRow = $cardResult->fetch_assoc();
    $cardNumber = $cardRow['card_number'];
    $lastFourDigits = substr($cardNumber, -4); // Get the last 4 digits
    echo "<td>".$lastFourDigits."</td>";
} else {
    echo "<td>N/A</td>";
}
        echo "<td>".$row['payment_status']."</td>";
        

echo "<td><a href='billin.php?invoice_number=" . $row['invoice_number'] . "'>Download Invoice</a></td>";

        echo "<td>".$row['work_status']."</td>";
        echo "<td>".$row['emp_id']."</td>";
        


        echo "<td>";
        echo "<form action='../admin/adassign_task.php' method='post'>";
        echo "<input type='hidden' name='id' value='" . $row["no"] . "'>";
        echo "<input type='text' name='employee_number'>";
        echo "<input type='submit' value='Assign Task' class='assign-button'>";
        echo "</form>";
        echo "<td>";
        echo "<form action='viewad.php' method='post'>";
        echo "<input type='hidden' name='delete' value='" . $row["no"] . "'>";
        echo "<input type='submit' value='Delete Task' class='red-button'>";
        echo "</form>";
        echo "</td>";
        echo "<td>";
        echo "<form action='viewad.php' method='post'>";
        echo "<input type='hidden' name='delete1' value='" . $row["no"] . "'>";
        echo "<input type='submit' value='Delete Booking' class='booking-button'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
        
    }

    echo "</table>";
    
} else {
    echo "No advertisements found.";
}

// Close the database connection
$conn->close();

?>
 <script>
        // JavaScript code for handling date selection
        document.addEventListener('DOMContentLoaded', function() {
            var calendarInput = document.getElementById('calendar-input');
            
            calendarInput.addEventListener('change', function() {
                var selectedDate = calendarInput.value;
                var expiryDateColumns = document.querySelectorAll('td.expiry-date');
                
                expiryDateColumns.forEach(function(column) {
                    var expiryDate = column.textContent;
                    var row = column.parentElement;
                    
                    if (expiryDate === selectedDate) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>