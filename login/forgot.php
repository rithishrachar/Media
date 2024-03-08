<?php include_once ("../controller.php"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Your Password In Php</title>
    <link rel="stylesheet" href="forgotn.css">
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
        <h3>Check if your email is registerd with us...!</h3>
        <!-- <p>It's quick and easy.</p> -->
        <div id="line"></div>
        <h5>Enter your Email:</h5>
        <form action="forgot.php" method="POST" autocomplete="off">
            <?php
            if ($errors > 0) {
                foreach ($errors as $displayErrors) {
            ?>
                    <div id="alert"><?php echo $displayErrors; ?></div>
            <?php
                }
            }
            ?>
            <input type="email" name="email" placeholder="example@gmail.com"><br>
            <input type="submit" name="forgot_password" value="Check">
        </form>
    </div>
</body>

</html>