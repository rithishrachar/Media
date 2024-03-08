<?php

@include 'config.php';
include_once ("../controller.php");

//session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn,$_POST['password']);
   $captcha = $_POST['captcha'];
   $captchaRand = $_POST['captcha-rand'];

   if ($captcha !== $captchaRand) {
      echo "<script>alert('Invalid captcha value');</script>";
   } else {
      $selectUser = "SELECT * FROM user WHERE email = '$email' AND password = '$pass' ";
      $selectEmployee = "SELECT * FROM employee WHERE email = '$email' AND password = '$pass' ";

      $resultUser = mysqli_query($conn, $selectUser);
      $resultEmployee = mysqli_query($conn, $selectEmployee);

      if(mysqli_num_rows($resultUser) > 0){

         $row = mysqli_fetch_array($resultUser);
         $_SESSION['user_id'] = $row['id'];
         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_name'] = $row['firstName'];
         $_SESSION['user_email'] = $row['email']; // Store user's email in session
         header('location:../Service/bookingx.php');

      } elseif (mysqli_num_rows($resultEmployee) > 0) {

         $row = mysqli_fetch_array($resultEmployee);
         
         if($row['degree'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:../admin/dashboard.php');
         } elseif($row['degree'] == 'employee'){
            $_SESSION['employee_name'] = $row['name'];
            $_SESSION['employee_id'] = $row['id'];
            header('location:../emp/dashboard2.php');
         }
      } else {
         $error[] = 'Incorrect email or password!';
      }
   }
}

$rand = rand(1000, 9999);
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="stylenn.css">
   <script src="https://kit.fontawesome.com/f1a5209d4b.js" crossorigin="anonymous"></script>
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>
<body>
   
    <!-- Add the navigation bar -->
    <header class="navigation-bar">
      <a href="#" class="logo">NEWS KARKALA</a>
      <nav>
         <ul class="navigation-links">
            <li><a href="../index.html">HOME</a></li>
            <li><a href="../home/aboutus.html">ABOUT</a></li>
            <li><a href="../home/services.html">SERVICES</a></li>
            <li><a href="../home/contact.php">CONTACT</a></li>
         </ul>
      </nav>
   </header>
<div class="form-container">

   <form action="" method="post">
      <h3>Login</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" placeholder="Enter your email" required>
      <input type="password" name="password" id="password" placeholder="Enter your password" required>
      <i class="fa-solid fa-eye-slash" id="show-password"></i>
      <div>
      <span>Enter Captcha</span>
      <div class="captcha-container">
         <input type="text" name="captcha" placeholder="Enter captcha" required><input type="text" name="captcha-rand" value="<?php echo $rand; ?>" readonly>
         <!-- <img src="captcha.php" alt="Captcha Image" class="captcha-image"> -->
      </div>
      
   </div>
      <input type="submit" name="submit" value="Login Now" class="form-btn">
      <p>Forgot password? <a href="forgot.php">Click here</a></p>
      <p>Don't have an account? <a href="register_form.php">Register now</a></p>
   </form>
   <script src="script.js"></script>

</div>

</body>
</html>
``
