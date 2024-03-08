<?php
require_once ('config.php');
$sql = "SELECT employee.id, employee.firstName, employee.lastName, salary.base, salary.bonus, salary.total FROM employee, salary WHERE employee.id = salary.id";
$result = mysqli_query($conn, $sql);
?>

<html>
<head>
    <title>Salary Table | XYZ Corporation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        header {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
        }
        
        h1 {
            margin: 0;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        #navli {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        
        #navli li {
            margin: 0 10px;
        }
        
        #navli li a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }
        
        #navli li a:hover {
            color: red;
        }
        
        .divider {
            height: 1px;
            background-color: #ccc;
            margin: 20px 0;
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            font-size: 16px;
            text-align: center;
        }
        
        th {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            text-align: center;
        }
        
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        
        input[type=text] {
            width: 80%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
            border: none;
            border-bottom: 1px solid #ccc;
        }
        
        input[type=text]:focus {
            outline: none;
            border-bottom: 1px solid #4CAF50;
        }
        
        a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }
        
        a:hover {
            color: #f44336;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <h1>NEWS KARKALA</h1>
            <ul id="navli">
                <li><a class="homeblack" href="dashboard.php">HOME</a></li>
                <li><a class="homered" href="salaryemp.php">SALARY TABLE</a></li>
                <li><a class="homeblack" href="../logout.php">LOGOUT</a></li>
            </ul>
        </nav>
    </header>
     
    <div class="divider"></div>
    <div id="divimg">
    </div>
    <center><h1>SALARY  DETAILS</h1></center>
    <table>
        <tr>
            <th align="center">Employee ID</th>
            <th align="center">Name</th>
            <th align="center">Base Salary</th>
            <th align="center">Bonus</th>
            <th align="center">Total Salary</th>
            <th align="center">Actions</th>
        </tr>
        
        <?php
        while ($employee = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$employee['id']."</td>";
            echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
            echo "<td><input type='text' name='base' value='".$employee['base']."'></td>";
            echo "<td><input type='text' name='bonus' value='".$employee['bonus']."'></td>";
            echo "<td>".$employee['total']."</td>";
            echo "<td><a href='updatesalary.php?id=".$employee['id']."&base=".$employee['base']."&bonus=".$employee['bonus']."'>Update</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
