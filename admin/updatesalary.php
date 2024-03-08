<?php

require_once ('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $base = $_POST['base'];
    $bonus = $_POST['bonus'];

    // Update the salary values in the database
    $sql = "UPDATE salary SET base = $base, bonus = $bonus, total = ($base + $bonus) WHERE id = $id";
    mysqli_query($conn, $sql);

    // Redirect back to the salary table page
    header('Location: salaryemp.php');
    exit();
} else {
    // If the request method is not POST, then retrieve the salary data from the database
    $id = $_GET['id'];
    $base = $_GET['base'];
    $bonus = $_GET['bonus'];
}

?>

<html>
<head>
    <title>Update Salary | XYZ Corporation</title>
    <link rel="stylesheet" type="text/css" href="updatesalary.css">
</head>
<body>
    <header>
        <nav>
            <h1>NEWS KARKALA</h1>
            <ul id="navli">
                <li><a class="homeblack" href="dashboard.php">HOME</a></li>
                <li><a class="homered" href="salaryemp.php">Salary Table</a></li>
                <li><a class="homeblack" href="../logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>

    <div class="divider"></div>
    <div id="divimg">
    </div>

    <form method="post" action="">
        <table>
            <tr>
                <th align="left">Employee ID:</th>
                <td><input type="text" name="id" value="<?php echo $id; ?>" readonly></td>
            </tr>
            <tr>
                <th align="left">Base Salary:</th>
                <td><input type="text" name="name" value="<?php echo $base; ?>" readonly></td>
            </tr>
            <tr>
                <th align="left">New Salary:</th>
                <td><input type="text" name="base" value="<?php echo $base; ?>"></td>
            </tr>
            <tr>
                <th align="left">Bonus:</th>
                <td><input type="text" name="bonus" value="<?php echo $bonus; ?>"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Update Salary"></td>
            </tr>
        </table>
    </form>
    
</body>

</html>
