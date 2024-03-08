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

        .filter-container {
            text-align: left;
            margin-bottom: 20px;
        }

        .filter-container select {
            padding: 5px;
            font-size: 16px;
        }
        .status-button {
    background-color: green;
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
    
</head>
<body>
    <div class="navbar">
        <a class="active" href="dashboard2.php">HOME</a>
        <a href="../logout.php">LOGOUT</a>
    </div>
    <div class="calendar">
        <input type="date" id="calendar-input">
    </div>
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $status = $_POST["status"];
        $sno = $_POST["id"];
    
        // Update the work status in the database
        $sql = "UPDATE advertisements SET work_status = '$status' WHERE no = '$sno'";
        if ($conn->query($sql) === TRUE) {
            // Display a success message and redirect after 3 seconds
            echo "<h1>Work status updated successfully.</h1>";
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'viewadtask.php';
                    }, 2000);
                  </script>";
        } else {
            echo "Error updating work status: " . $conn->error;
        }
    }

    $employeeID = $_SESSION['employee_id'];

    // Retrieve all rows with task_type = "advertisement"
    $sql = "SELECT * FROM task WHERE task_type = 'advertisement'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h1>ADVERTISEMENT TASKS</h1>";

        echo "<div class='filter-container'>";
        echo "<label>Filter by Work Status:</label>";
        echo "<select id='filter-status' onchange='applyFilter()'>";
        echo "<option value='all'>All</option>";
        echo "<option value='Pending'>Pending</option>";
        echo "<option value='Complete'>Complete</option>";
        echo "<option value='In Progress'>In Progress</option>";
        echo "<option value='Cancelled'>Cancelled</option>";
        echo "</select>";
        echo "</div>";

        echo "<table id='task-table'>";
        echo "<tr><th>Task ID</th><th>Booking NO</th><th>Name</th><th>Email</th><th>Number</th><th>Ad Type</th><th>Ad Details</th><th>File</th><th>Expiry Date</th><th>Remaining Days</th><th>Payment Status</th><th>Employee Number(Task Assigned)</th><th>Work Status</th><th>Update Work Status</th>";

        while ($row = $result->fetch_assoc()) {
            if ($row['employee_number'] == $employeeID) {
                echo "<tr class='task-row' data-status='" . $row['task_status'] . "'>";
                echo "<td>" . $row['task_id'] . "</td>";
                echo "<td>" . $row['sno'] . "</td>";
                echo "<td>" . $row['name1'] . "</td>";
                echo "<td>" . $row['email1'] . "</td>";
                echo "<td>" . $row['number'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['artical'] . "</td>";
                echo "<td><a href='../Service/adfiles/" . $row["file"] . "' download>" . $row["file"] . "</a></td>";
                // echo "<td>" . $row['ev_date'] . "</td>";
                echo "<td class='ev-date'>".$row['ev_date']."</td>";

                echo "<td>" . $row['remaining_days'] . "</td>";
                echo "<td>" . $row['payment_status'] . "</td>";
                echo "<td><center>" . $row["employee_number"] . "</center></td>";

                // Fetch and display the work status from the "advertisement" table
                $advertisementID = $row['sno'];
                $workStatusSql = "SELECT work_status FROM advertisements WHERE no = '$advertisementID'";
                $workStatusResult = $conn->query($workStatusSql);
                if ($workStatusResult->num_rows > 0) {
                    $workStatusRow = $workStatusResult->fetch_assoc();
                    echo "<td>" . $workStatusRow['work_status'] . "</td>";
                } else {
                    echo "<td>N/A</td>";
                }

                echo "<td>";
                echo "<form action='viewadtask.php' method='post'>";
                echo "<input type='hidden' name='id' value='" . $row["sno"] . "'>";
                echo "<select name='status'>";
                echo "<option value='Pending' " . ($row["task_status"] == "Pending" ? "selected" : "") . ">Pending</option>";
                echo "<option value='Complete' " . ($row["task_status"] == "Complete" ? "selected" : "") . ">Complete</option>";
                echo "<option value='In Progress' " . ($row["task_status"] == "In Progress" ? "selected" : "") . ">In Progress</option>";
                echo "<option value='Cancelled' " . ($row["task_status"] == "Cancelled" ? "selected" : "") . ">Cancelled</option>";
                echo "</select>";
                echo "<input type='submit' value='Update' class='status-button'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
    } else {
        echo "<h1>No task  found </h1>";
    }

    // Close the database connection
    $conn->close();
    ?>

    <script>
        function applyFilter() {
            var selectedStatus = document.getElementById("filter-status").value;
            var taskRows = document.getElementsByClassName("task-row");

            for (var i = 0; i < taskRows.length; i++) {
                var taskStatus = taskRows[i].getAttribute("data-status");

                if (selectedStatus === "all" || taskStatus === selectedStatus) {
                    taskRows[i].style.display = "";
                } else {
                    taskRows[i].style.display = "none";
                }
            }
        }
    </script>
     <script>
        // JavaScript code for handling date selection
        document.addEventListener('DOMContentLoaded', function() {
            var calendarInput = document.getElementById('calendar-input');
            
            calendarInput.addEventListener('change', function() {
                var selectedDate = calendarInput.value;
                var expiryDateColumns = document.querySelectorAll('td.ev-date');
                
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
