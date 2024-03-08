<?php
session_start();

// Retrieve the employee ID from session storage
$employeeId = $_SESSION['employee_id'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Leave Management</title>
	<link rel="stylesheet" type="text/css" href="e1.css">
</head>
<body>
<nav>
        <ul>
            <li><a href="dashboard2.php">Home</a></li>
            <li><a href="e2.php">Apply Leave</a></li>
            <li><a href="leavestatus.php">Leave Status</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </nav>
	<h1>APPLY LEAVE</h1>
	<form method="post" action="leave_request.php">
		<label for="emp_id">Employee ID:</label>
		<input type="text" id="emp_id" name="emp_id" value="<?php echo $employeeId; ?>" readonly><br><br>

		<label for="emp_name">Employee Name:</label>
		<input type="text" id="emp_name" name="emp_name" required><br><br>

		<label for="leave_reason">Leave Reason:</label>
		<input type="text" id="leave_reason" name="leave_reason" required><br><br>

		<label for="leave_start_date">Leave Start Date:</label>
		<input type="date" id="leave_start_date" name="leave_start_date" required><br><br>

		<label for="leave_end_date">Leave End Date:</label>
		<input type="date" id="leave_end_date" name="leave_end_date" required><br><br>

		<input type="submit" value="Submit">
	</form>

	<script>
		// Fetch employee name from session storage
		var empName = sessionStorage.getItem('employee_name');

		// Set the value in the corresponding input field
		document.getElementById('emp_name').value = empName;
	</script>
</body>
</html>
