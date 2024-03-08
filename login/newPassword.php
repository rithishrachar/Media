<?php include_once ("../controller.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="forgotn2.css">
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
    <h3>Set New Password 🔑</h3>
    <div id="line"></div>
    <form action="newPassword.php" method="POST" autocomplete="off">
        <?php
        if (isset($_POST['changePassword'])) {
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

            $errors = array();

            // Password validation conditions
            if (strlen($password) < 8) {
                $errors['password_error'] = 'Password must contain at least 8 characters.';
            }

            if (!preg_match('/[A-Z]/', $password)) {
                $errors['password_error'] = 'Password must contain at least one uppercase letter.';
            }

            if (!preg_match('/[a-z]/', $password)) {
                $errors['password_error'] = 'Password must contain at least one lowercase letter.';
            }

            if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
                $errors['password_error'] = 'Password must contain at least one special character.';
            }

            if ($password != $confirmPassword) {
                $errors['password_error'] = 'Passwords do not match.';
            }

            if (count($errors) === 0) {
                $email = $_SESSION['email'];
                $updatePassword = "UPDATE employee SET password = '$password' WHERE email = '$email'";
                $updatePass = mysqli_query($conn, $updatePassword) or die("Query Failed");
                session_destroy();
                header('location: login_form.php');
            }
        }
        ?>

        <?php
        if (isset($errors) && count($errors) > 0) {
            foreach ($errors as $error) {
                echo '<div id="alert">' . $error . '</div>';
            }
        }
        ?>

        <input type="password" name="password" placeholder="Enter New Password" required><br>
        <input type="password" name="confirmPassword" placeholder="Confirm New Password" required><br>
        <input type="submit" name="changePassword" value="Save">
    </form>
</div>
</body>
</html>
