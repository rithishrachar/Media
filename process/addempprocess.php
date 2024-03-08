<?php
require_once ('dbh.php');

$firstname = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$dept = $_POST['dept'];
$salary = $_POST['salary'];
$birthday = $_POST['birthday'];
$password = $_POST['password'];
$files = $_FILES['file'];
$filename = $files['name'];
$fileerror = $files['error'];
$filetemp = $files['tmp_name'];
$fileext = explode('.', $filename);
$filecheck = strtolower(end($fileext));
$fileextstored = array('png', 'jpg', 'jpeg');
$degree = 'employee';

// Validation for first name and last name
if (!preg_match('/^[A-Za-z]+$/', $firstname) || !preg_match('/^[A-Za-z]+$/', $lastName)) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('First name and last name should only contain letters.')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
    exit;
}

// Validation for contact number
if (!preg_match('/^[0-9]{10}$/', $contact)) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Contact number should be a 10-digit number.')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
    exit;
}

// Check if the file name already exists
$destinationfile = 'images/' . $filename;
if (file_exists($destinationfile)) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('File name already exists. Please choose a different photo.')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
    exit;
}

if (in_array($filecheck, $fileextstored)) {
    move_uploaded_file($filetemp, $destinationfile);

    $sql = "INSERT INTO `employee`(`id`, `firstName`, `lastName`, `email`, `password`, `birthday`, `gender`, `contact`, `address`, `dept`, `degree`, `pic`) VALUES ('','$firstname','$lastName','$email','$password','$birthday','$gender','$contact','$address','$dept','$degree','$destinationfile')";

    $result = mysqli_query($conn, $sql);

    $last_id = $conn->insert_id;

    $sqlS = "INSERT INTO `salary`(`id`, `base`, `bonus`, `total`) VALUES ('$last_id','$salary',0,'$salary')";
    $salaryQ = mysqli_query($conn, $sqlS);

    if ($result == 1) {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Successfully Registered')
        window.location.href='../admin/viewemp.php';
        </SCRIPT>");
    } else {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Failed to Register')
        window.location.href='javascript:history.go(-1)';
        </SCRIPT>");
    }
} else {
    $sql = "INSERT INTO `employee`(`id`, `firstName`, `lastName`, `email`, `password`, `birthday`, `gender`, `contact`, `address`, `dept`, `degree`, `pic`) VALUES ('','$firstname','$lastName','$email','$password','$birthday','$gender','$contact','$address','$dept','$degree','images/no.jpg')";

    $result = mysqli_query($conn, $sql);

    $last_id = $conn->insert_id;

    $sqlS = "INSERT INTO `salary`(`id`, `base`, `bonus`, `total`) VALUES ('$last_id','$salary',0,'$salary')";
    $salaryQ = mysqli_query($conn, $sqlS);
    $rank = mysqli_query($conn, "INSERT INTO `rank`(`eid`) VALUES ('$last_id')");

    if ($result == 1) {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Successfully Registered')
        window.location.href='../admin/viewemp.php';
        </SCRIPT>");
    } else {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Failed to Register')
        window.location.href='javascript:history.go(-1)';
        </SCRIPT>");
    }
}
?>
