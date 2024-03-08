<?php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the advertisement ID and assigned employee number from the form
    $advertisementId = $_POST['id'];
    $employeeNumber = $_POST['employee_number'];

    // Validate the input (you can add more validation as per your requirements)
    if (empty($advertisementId) || empty($employeeNumber)) {
        echo "Please provide both the advertisement ID and the employee number.";
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

    // Check if the task is already assigned to the employee
    $checkSql = "SELECT * FROM task WHERE sno = $advertisementId AND employee_number = $employeeNumber";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        echo "The task is already assigned to the specified employee.";
        $conn->close();
        exit;
    }

    // Check if the advertisement exists
    $sql = "SELECT * FROM advertisements WHERE no = $advertisementId";
    $result = $conn->query($sql);

    if ($result->num_rows === 0) {
        echo "Advertisement not found.";
        $conn->close();
        exit;
    }

    // Update the advertisement with the assigned employee number
    $sql = "UPDATE advertisements SET emp_id = $employeeNumber WHERE no = $advertisementId";
    if ($conn->query($sql) === TRUE) {
        // Retrieve the assigned task data from the 'advertisements' table
        $selectSql = "SELECT * FROM advertisements WHERE no = $advertisementId";
        $row = $conn->query($selectSql)->fetch_assoc();

        // Insert the assigned task data into the 'task' table
        $insertSql = "INSERT INTO task (sno, employee_number, name1, email1, number, title, artical, file, ev_date, remaining_days, payment_status, task_type, task_status) VALUES ('$advertisementId', '$employeeNumber', '{$row['name']}', '{$row['email']}', '{$row['number']}', '{$row['title']}', '{$row['artical']}', '{$row['file']}', '{$row['expiry_date']}', '{$row['remaining_days']}', '{$row['payment_status']}', '{$row['task_type']}', '{$row['work_status']}')";
        if ($conn->query($insertSql) === TRUE) {
            echo '<div style="background-color: #FF0000; color: #fff; padding: 50px; text-align: center;">Task assigned successfully. Redirecting...</div>';
            header("refresh:5; url=http://localhost/newskarkala/Service/viewad.php"); // Redirect to success page after 5 seconds
        } else {
            echo "Error inserting task data: " . $conn->error . " Redirecting...";
            header("refresh:5; url=http://localhost/newskarkala/Service/viewad.php"); // Redirect to error page after 5 seconds
        }
    } else {
        echo "Error assigning task: " . $conn->error . " Redirecting...";
        header("refresh:5; url=http://localhost/newskarkala/Service/viewad.php"); // Redirect to error page after 5 seconds
    }

    $conn->close();
    exit;
} else {
    echo "Invalid request.";
}
