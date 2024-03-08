<?php include_once ("../controller.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification Form</title>
    <link rel="stylesheet" href="otpn.css">
    <style>
        /* CSS for navigation bar */
        .navbar {
            display: flex;
            justify-content: space-between;
            background-color: #f0f0f0;
            padding: 10px;
        }

        .navbar ul {
            list-style-type: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            margin-right: 10px;
        }

        .navbar ul li a {
            text-decoration: none;
            color: #333;
            padding: 5px;
            border-radius: 5px;
        }

        .navbar ul li a:hover {
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="navbar">
            <ul>
                <li><a href="../index.html">HOME</a></li>
                <li><a href="login_form.php">LOGIN</a></li>
                <li><a href="../logout.php">LOGOUT</a></li>
            </ul>
        </div>
    <div id="container">
        <h3>OTP Verification</h3>
        <p>OTP is valid for 1 Minutes</p>
        <div id="line"></div>
        <form action="verifyEmail.php" method="POST" autocomplete="off">
            <?php
            if(isset($_SESSION['message'])){
                ?>
                <div id="alert"><?php echo $_SESSION['message']; ?></div>
                <?php
            }
            ?>

            <?php
            if($errors > 0){
                foreach($errors AS $displayErrors){
                ?>
                <div id="alert"><?php echo $displayErrors; ?></div>
                <?php
                }
            }
            ?>      
            <input type="number" name="OTPverify" placeholder="Enter 6 digit OTP" required><br>
            <input type="submit" name="verifyEmail" value="Verify">
            
        </form>
        <form action="verifyEmail.php" method="POST" autocomplete="off">
            <input type="submit" name="resend_otp" value="Resend OTP">
            </form>
    </div>
</body>
</html>