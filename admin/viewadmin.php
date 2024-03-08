<?php

require_once ('../process/dbh.php');
$sql = "SELECT * FROM `employee` WHERE `degree`='admin'";
$result = mysqli_query($conn, $sql);

?>
<html>
<head>
	<title>View Employee |  Admin Panel | NEWS KARKALA</title>
	<link rel="stylesheet" type="text/css" href="styleview.css">
</head>
<body>
	<header>
		<nav>
			<h1>NEWS KARKALA</h1>
			<ul id="navli">
				<li><a class="homeblack" href="dashboard.php">HOME</a></li>
				<!-- <li><a class="homeblack" href="addemp.php">Add Employee</a></li>
				<li><a class="homered" href="viewemp.php">View Employee</a></li>
				<li><a class="homeblack" href="assign.php">Assign Project</a></li>
				<li><a class="homeblack" href="assignproject.php">Project Status</a></li>
				<li><a class="homeblack" href="salaryemp.php">Salary Table</a></li>
				<li><a class="homeblack" href="empleave.php">Employee Leave</a></li> -->
				<li><a class="homeblack" href="../logout.php">LOGOUT</a></li>
			</ul>
		</nav>
	</header>
	
	<div class="divider"></div>

		<table>
			<tr>

				<th align = "center">Emp. ID</th>
				<th align = "center">Picture</th>
				<th align = "center">Name</th>
				<th align = "center">Email</th>
				<!-- <th align = "center">Password</th> -->
			</tr>

			<?php
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$employee['id']."</td>";
					echo "<td><img src='../process/admin_pic/".$employee['pic']."' height = 60px width = 60px></td>";
					echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
					
					echo "<td>".$employee['email']."</td>";
					// echo "<td>".$employee['password']."</td>";
				}
			?>

		</table>
</body>
</html>