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

if (isset($_POST['employee_number'])) {
    // Retrieve booking details from database
    $sql = "SELECT * FROM youtube WHERE sno = '".$_POST['id']."'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Retrieve employee details from database
    $sql2 = "SELECT * FROM employee WHERE id = '".$_POST['employee_number']."'";
    $result2 = mysqli_query($conn, $sql2);

    if (mysqli_num_rows($result2) > 0) {
        $row2 = mysqli_fetch_assoc($result2);

        // Check if the task has already been assigned to the selected employee
        $checkSql = "SELECT * FROM task WHERE sno = '".$row["sno"]."' AND employee_number = '".$row2["id"]."'";
        $checkResult = mysqli_query($conn, $checkSql);

        if (mysqli_num_rows($checkResult) > 0) {
            // Task already assigned to the selected employee
            echo '<div style="background-color: #FF0000; color: #fff; padding: 50px; text-align: center;">This Task is already assigned to the selected employee.Redirecting to Youtube Status page in 5 seconds...</div>';
            header("refresh:3;url=youtubestatus.php"); // Redirect to youtubestatus.php after 5 seconds
        } else {
            // Insert data into task table
            $sql3 = "INSERT INTO task (sno, name1, email1, ev_date, ev_name, number, address, pincode, employee_number) VALUES ('".$row["sno"]."', '".$row["name1"]."', '".$row["email1"]."', '".$row["ev_date"]."', '".$row["ev_name"]."', '".$row["number"]."', '".$row["address"]."', '".$row["pincode"]."', '".$row2["id"]."')";

            if (mysqli_query($conn, $sql3)) {
                // Task assigned successfully
                echo '<div style="background-color: #4CAF50; color: #fff; padding: 50px; text-align: center;">Task assigned successfully. Redirecting to Youtube Status page in 5 seconds...</div>';
                header("refresh:3;url=youtubestatus.php"); // Redirect to youtubestatus.php after 5 seconds

                // Update the assigned employee ID in the YouTube table
                $assignedEmployeeID = $row2["id"];
                $updateSql = "UPDATE youtube SET employee_id = '".$assignedEmployeeID."' WHERE sno = '".$_POST['id']."'";
                mysqli_query($conn, $updateSql);
            } else {
                // Error assigning task
                echo "Error assigning task: " . mysqli_error($conn);
            }
        }
    } else {
        // Invalid employee number
        echo '<div style="background-color: #FF0000; color: #fff; padding: 50px; text-align: center;">Invalid employee number. Redirecting to Youtube Status page in 5 seconds...</div>';
        header("refresh:3;url=youtubestatus.php"); // Redirect to youtubestatus.php after 5 seconds
    }
}

// Close database connection
mysqli_close($conn);
?>