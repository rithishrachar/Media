<?php
require_once ('../process/dbh.php');
$sql = "SELECT * FROM `employee` WHERE 1";

$result = mysqli_query($conn, $sql);

if(isset($_POST['update'])){
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$firstname = mysqli_real_escape_string($conn, $_POST['firstName']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lastName']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
	$contact = mysqli_real_escape_string($conn, $_POST['contact']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$gender = mysqli_real_escape_string($conn, $_POST['gender']);
	$dept = mysqli_real_escape_string($conn, $_POST['dept']);

	$result = mysqli_query($conn, "UPDATE `employee` SET `firstName`='$firstname', `lastName`='$lastname', `email`='$email', `birthday`='$birthday', `gender`='$gender', `contact`='$contact', `address`='$address', `dept`='$dept' WHERE id=$id");

	if($result) {
		echo ("<SCRIPT LANGUAGE='JavaScript'>
    			window.alert('Succesfully Updated')
    			window.location.href='viewemp.php';
    			</SCRIPT>");
	} else {
		echo "Error: " . mysqli_error($conn);
	}
}

$id = (isset($_GET['id']) ? $_GET['id'] : '');
$sql = "SELECT * from `employee` WHERE id=$id";
$result = mysqli_query($conn, $sql);
if($result){
	while($res = mysqli_fetch_assoc($result)){
		$firstname = $res['firstName'];
		$lastname = $res['lastName'];
		$email = $res['email'];
		$contact = $res['contact'];
		$address = $res['address'];
		$gender = $res['gender'];
		$birthday = $res['birthday'];
		$dept = $res['dept'];
	}
}
?>
<?php

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the value of the contact input field
    $contact = $_POST["contact"];

    // Validate the contact input field
    if (!preg_match("/^[0-9]{10}$/", $contact)) {
        // The contact input field is not valid
        echo "Please enter a valid 10-digit phone number.";
    } else {
        // The contact input field is valid
        // Do something with the contact information
    }

}

?>


<html>
<head>
	<title>View Employee |  Admin Panel |</title>
	<!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="../css/main.css" rel="stylesheet" media="all">
    <style>
    body {
    font-family: 'Roboto', sans-serif;
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

.title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
}

.card {
    background-color: #ffffff;
    border-radius: 10px;
    overflow: hidden;
    padding: 30px;
    margin-bottom: 20px;
    box-shadow: 0 10px 30px 0 rgba(0, 0, 0, 0.1);
}

.input-group {
    margin-bottom: 20px;
}

.input--style-1 {
    padding: 17px 20px;
    border-radius: 5px;
    width: 100%;
}

.input--style-1:focus {
    box-shadow: none;
}

.btn--radius {
    border-radius: 5px;
    padding: 17px 35px;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn--radius:hover {
    transform: translateY(-3px);
}

.btn--green {
    background-color: #4CAF50;
    color: #ffffff;
    border: none;
}

.btn--green:hover {
    background-color: #45a049;
}

.btn--red {
    background-color: #ff4f4f;
    color: #ffffff;
    border: none;
}

.btn--red:hover {
    background-color: #ff3838;
}

.p-t-20 {
    padding-top: 20px;
}

.col-2 {
    width: 50%;
    float: left;
}

.row-space {
    margin-bottom: 20px;
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
				<li><a class="homered" href="viewemp.php">View Employee</a></li> -->
				<li><a class="homeblack" href="../logout.php">LOGOUT</a></li>
			</ul>
		</nav>
	</header>
	
	<div class="divider"></div>
	

		<!-- <form id = "registration" action="edit.php" method="POST"> -->
	<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">UPDATE EMPLOYEE INFORMATION</h2>
                    <form id = "registration" action="edit.php" method="POST">

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                     <input class="input--style-1" type="text" name="firstName"  placeholder="Enter the first name "value="<?php echo $firstname;?>" pattern="[A-Za-z ]+" title="Only characters are allowed">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" name="lastName" placeholder="Enter the last name " value="<?php echo $lastname;?>"pattern="[A-Za-z ]+" title="Only characters are allowed">
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="email"  name="email" value="<?php echo $email;?>" readonly>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="date" name="birthday" value="<?php echo $birthday;?>">
                                   
                                </div>
                            </div>
                            <div class="col-2">
                            <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="gender">
                                            <option disabled="disabled" selected="selected">GENDER</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Enter the phone number" name="contact" value="<?php echo $contact;?>" pattern="[0-9]{10}" title="Phone number should contain 10 digits">
                        </div>

                        <!-- <div class="input-group">
                            <input class="input--style-1" type="number" name="nid" value="<?php echo $nid;?>">
                        </div> -->

                        
                         <div class="input-group">
                            <input class="input--style-1" type="text"  name="address" value="<?php echo $address;?>">
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" name="dept" value="<?php echo $dept;?>">
                        </div>
                        

                        <!-- <div class="input-group">
                            <input class="input--style-1" type="text" name="degree" value="<?php echo $degree;?>">
                        </div> -->
                        <input type="hidden" name="id" id="textField" value="<?php echo $id;?>" required="required"><br><br>
                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit" name="update">Submit</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>
</html>
