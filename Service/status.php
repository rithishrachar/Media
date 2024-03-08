<html>
  <head>
  <style>
  
  /* Add your creative CSS styling here */
  body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
  }

  .navbar {
      background-color:aquamarine;
      color: #fff;
      display: flex;
      justify-content: space-between;
      padding: 10px;
  }

  .navbar h1 {
      margin: 0;
      font-size: 24px;
  }

  .navbar ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
  }

  .navbar ul li {
      margin-left: 10px;
  }

  .content {
      padding: 20px;
  }
  
</style>
  </head>
  <body>
  <div class="navbar">
        <h1>BOOKING STATUS</h1>
        <ul>
            <li><a href="bookingx.php">HOME</a></li>
            <li><a href="../logout.php">LOGOUT</a></li>
            <!-- <li><a href="#">Contact</a></li> -->
        </ul>
    </div>
  </body>
</html>
<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];

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

    // Handle row deletion
    if (isset($_GET['sno'])) {
        $sno = $_GET['sno'];

        // Get the event date of the booking
        $eventDateQuery = "SELECT ev_date FROM youtube WHERE sno = $sno";
        $eventDateResult = mysqli_query($conn, $eventDateQuery);
        $eventDateRow = mysqli_fetch_assoc($eventDateResult);
        $eventDate = $eventDateRow['ev_date'];

        // Calculate the difference in hours between the current time and the event date
        $currentDateTime = new DateTime();
        $eventDateTime = new DateTime($eventDate);
        $hoursDifference = $currentDateTime->diff($eventDateTime)->h;

        // Check if the difference is less than or equal to 48 hours
        if ($hoursDifference <= 48) {
            // Cannot cancel the booking anymore
            // echo "You cannot cancel this booking as the event date is within 48 hours.";
            echo '<div style="background-color: #FF0000; color: #fff; padding: 50px; text-align: center;">You cannot cancel this booking as the event date is within 48 hours.Contact Us to Cancel the Booking</div>';
            header("refresh:3;url=status.php"); // Redirect to youtubestatus.php after 5 seconds
        
        } else {
            // Proceed with the deletion
            $deleteSql = "DELETE FROM youtube WHERE sno = $sno";
            if (mysqli_query($conn, $deleteSql)) {
                // Deletion successful
                echo "Row deleted successfully.";
            } else {
                // Deletion failed
                echo "Error deleting row: " . mysqli_error($conn);
            }
        }
    }

    // Retrieve booking requests from database for the logged-in user's email
    $sql = "SELECT * FROM youtube WHERE email1 IN (SELECT email FROM user WHERE id = $userID)";
    $result = mysqli_query($conn, $sql);

    echo "<h1><center>YOUTUBE BOOKING STATUS</center></h1>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Event Date</th><th>Event Name</th><th>Phone Number</th><th>Address</th><th>Pincode</th><th>Status</th><th>Cancel</th></tr>";

    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["sno"] . "</td>";
            echo "<td>" . $row["name1"] . "</td>";
            echo "<td>" . $row["email1"] . "</td>";
            echo "<td>" . $row["ev_date"] . "</td>";
            echo "<td>" . $row["ev_name"] . "</td>";
            echo "<td>" . $row["number"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["pincode"] . "</td>";
            echo "<td>" . $row["status"] . "</td>";
            echo "<td><button onclick=\"deleteRow(" . $row["sno"] . ")\">Cancel</button></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='10'>No booking requests found.</td></tr>";
    }

    echo "</table>";

    // Close database connection
    mysqli_close($conn);
} else {
    echo "<p>You are not logged in.</p>";
}
?>

<script>
    function deleteRow(sno) {
        var confirmation = confirm("Are you sure you want to cancel this booking?");
        if (confirmation) {
            // Reload the page with the sno parameter to handle deletion
            location.href = "status.php?sno=" + sno;
        }
    }
</script>


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
  background-color: #f2f2f2;
  color: #444;
  font-weight: normal;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

tr:hover {
  background-color: #ddd;
}

table th {
  background-color: #dc0606ca;
}

</style>

<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];

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

    // Retrieve data from the 'articals' table for the logged-in user's email
    $sql = "SELECT * FROM articals WHERE email3 IN (SELECT email FROM user WHERE id = $userID)";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<html>";
        echo "<div>";
        echo "<h1><center>ARTICLE BOOKING</center></h1>";
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Phone Number</th>";
        echo "<th>Title</th>";
        echo "<th>Article</th>";
        echo "<th>File</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["name3"] . "</td>";
                echo "<td>" . $row["email3"] . "</td>";
                echo "<td>" . $row["number"] . "</td>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . $row["artical"] . "</td>";
                echo "<td><a href='artfiles/" . $row["file"] . "'>Download</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found.</td></tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "<style>";
        echo "table { border-collapse: collapse; width: 100%; }";
        echo "th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }";
        echo "th { background-color: #f5f5f5; }";
        echo "</style>";
        echo "</html>";

        // Close database connection
        mysqli_close($conn);
    } else {
        echo "Error retrieving data: " . mysqli_error($conn);
    }
} else {
    echo "User not logged in.";
}
?>

<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  border: 1px solid blue;
  padding: 8px;
  text-align: left;
}

th {
  background-color:blue;
}
</style>



<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];

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

    // Retrieve data from the 'articals' table for the logged-in user's email
    $sql = "SELECT * FROM advertisements WHERE email IN (SELECT email FROM user WHERE id = $userID)";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<html>";
        echo "<div>";
        echo "<h1><center>ADVERTISEMENTS BOOKING</center></h1>";
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Phone Number</th>";
        echo "<th>Title</th>";
        echo "<th>Article</th>";
        echo "<th>File</th>";
        echo "<th>Duration</th>";
        echo "<th>Amount</th>";
        echo "<th>Payment Mode</th>";
        echo "<th>Payment Status</th>";
        echo "<th>Invoice</th>";
        echo "<th>Payment Date</th>";
        echo "<th>Expiry Date</th>";
        echo "<th>Remaining Days</th>";
        echo "<th>Invoice Number</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["number"] . "</td>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . $row["artical"] . "</td>";
                echo "<td><a href='adfiles/" . $row["file"] . "'>Download</a></td>";
                echo "<td>" . $row["duration"] . "</td>";
                echo "<td>" . $row["amount"] . "</td>";
                echo "<td>" . $row["payment_mode"] . "</td>";
                echo "<td>" . $row["payment_status"] . "</td>";
                echo "<td><a href='billin.php?invoice_number=" . $row['invoice_number'] . "'>Download Invoice</a></td>";

                echo "<td>" . $row["created_at"] . "</td>";
                echo "<td>" . $row["expiry_date"] . "</td>";
                echo "<td>" . $row["remaining_days"] . "</td>";
                echo "<td>" . $row["invoice_number"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found.</td></tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "<style>";
        echo "table { border-collapse: collapse; width: 100%; }";
        echo "th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }";
        echo "th { background-color: #f5f5f5; }";
        echo "</style>";
        echo "</html>";

        // Close database connection
        mysqli_close($conn);
    } else {
        echo "Error retrieving data: " . mysqli_error($conn);
    }
} else {
    echo "User not logged in.";
}
?>

<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color:goldenrod;
}
</style>
