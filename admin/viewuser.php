<?php

require_once ('../process/dbh.php');
$sql = "SELECT * FROM `user` WHERE `degree`='user'";
$result = mysqli_query($conn, $sql);

?>
<html>
<head>
	<title>View Employee |  Admin Panel | NEWS KARKALA</title>
	<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #990000;
            color: #ffffff;
            height: 60px;
            padding: 20px;
        }

        #navli {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        #navli li {
            float: left;
        }

        #navli li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        #navli li a:hover {
            background-color: #111;
        }

        .divider {
            border-bottom: 1px solid #ccc;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }
    </style>
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

				<th align = "center">ID</th>
				<th align = "center">Picture</th>
				<th align = "center">Name</th>
				<th align = "center">Email</th>
				<!-- <th align = "center">Password</th> -->
				<th align = "center">Address</th>
				<th align = "center">Options</th>
			</tr>

			<?php
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$employee['id']."</td>";
					echo "<td><img src='../login/user_img/".$employee['pic']."' height = 60px width = 60px></td>";
					echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
					echo "<td>".$employee['email']."</td>";
					// echo "<td>".$employee['password']."</td>";
					echo "<td>".$employee['address']."</td>";
					echo "<td> <a href=\"deleteuser.php?id=$employee[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";

				}
			?>
	</table>	
</body>
</html>