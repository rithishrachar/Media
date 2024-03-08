<?php
require_once('../process/dbh.php');
session_start();

// Check if the employee is logged in
if (!isset($_SESSION['email'])) {
    header("Location: ../login/login_form.php");
    exit();
}

$loggedInEmail = $_SESSION['email'];

// Retrieve the details of the logged-in employee
$sql = "SELECT * FROM `employee` WHERE email='$loggedInEmail'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    $firstname = $row['firstName'];
    $lastname = $row['lastName'];
    $email = $row['email'];
    $contact = $row['contact'];
    $address = $row['address'];
    $gender = $row['gender'];
    $birthday = $row['birthday'];
    $dept = $row['dept'];
} else {
    echo "Employee not found.";
    exit();
}

if (isset($_POST['update'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastName']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
    $dept = mysqli_real_escape_string($conn, $_POST['dept']);

    $result = mysqli_query($conn, "UPDATE `employee` SET `firstName`='$firstname', `lastName`='$lastname', `contact`='$contact', `address`='$address', `gender`='$gender', `birthday`='$birthday', `dept`='$dept' WHERE id=$id");

    if ($result) {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Successfully Updated')
            window.location.href='viewemp.php';
            </SCRIPT>");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>
<!-- HTML and form code -->
<!DOCTYPE html>
<html>
<head>
	<title>View Employee | Admin Panel | XYZ Corporation</title>
	<!-- Add CSS links and styles here -->
</head>
<body>
	<header>
		<!-- Add header content here -->
	</header>

	<!-- Add any other necessary divs and elements here -->

	<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
	    <div class="wrapper wrapper--w680">
	        <div class="card card-1">
	            <div class="card-heading"></div>
	            <div class="card-body">
	                <h2 class="title">Update Employee Info</h2>
	                <form id="registration" action="profilep.php" method="POST">
	                    <div class="row row-space">
	                        <div class="col-2">
	                            <div class="input-group">
	                                <input class="input--style-1" type="text" name="firstName" value="<?php echo $firstname; ?>" required>
	                            </div>
	                        </div>
	                        <div class="col-2">
	                            <div class="input-group">
	                                <input class="input--style-1" type="text" name="lastName" value="<?php echo $lastname; ?>" required>
	                            </div>
	                        </div>
	                    </div>

	                    <div class="input-group">
	                        <input class="input--style-1" type="email" name="email" value="<?php echo $email; ?>" readonly>
	                    </div>
	                    <div class="row row-space">
	                        <div class="col-2">
	                            <div class="input-group">
	                                <input class="input--style-1" type="date" name="birthday" value="<?php echo $birthday; ?>">
	                            </div>
	                        </div>
	                        <div class="col-2">
	                            <div class="input-group">
	                                <div class="rs-select2 js-select-simple select--no-search">
	                                    <select name="gender">
	                                        <option disabled="disabled" selected="selected">GENDER</option>
	                                        <option value="Male" <?php if ($gender == 'Male') echo 'selected'; ?>>Male</option>
	                                        <option value="Female" <?php if ($gender == 'Female') echo 'selected'; ?>>Female</option>
	                                        <option value="Other" <?php if ($gender == 'Other') echo 'selected'; ?>>Other</option>
	                                    </select>
	                                    <div class="select-dropdown"></div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>

	                    <div class="input-group">
	                        <input class="input--style-1" type="number" name="contact" value="<?php echo $contact; ?>">
	                    </div>

	                    <div class="input-group">
	                        <input class="input--style-1" type="text" name="address" value="<?php echo $address; ?>">
	                    </div>

	                    <div class="input-group">
	                        <input class="input--style-1" type="text" name="dept" value="<?php echo $dept; ?>">
	                    </div>

	                    <input type="hidden" name="id" value="<?php echo $id; ?>">
	                    <div class="p-t-20">
	                        <button class="btn btn--radius btn--green" type="submit" name="update">Submit</button>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>

