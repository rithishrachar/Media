<?php

include 'config.php';

session_start();

$employee_id = $_SESSION['employee_id'];


if(!isset($employee_id)){
   header('location:../login/login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>employee page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   <!-- Navigation Bar -->
   <nav class="navbar">
   <ul class="navbar-items">
      <li class="navbar-item">
         <a href="../emp/dashboard2.php" class="navbar-link">Home</a>
      </li>
    
      <li class="navbar-item">
         <a href="../logout.php" class="navbar-link">Logout</a>
      </li>
   </ul>
</nav>
<h1 class="title"> <span>Employee</span> profile page </h1>

<section class="profile-container">

   <?php
      $select_profile = $conn->prepare("SELECT * FROM `employee` WHERE id = ?");
      $select_profile->execute([$employee_id]);
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
   ?>

   <div class="profile">
   <img src="../process/images/<?= $fetch_profile['pic']; ?>" alt="">
      <h3><?= $fetch_profile['firstName']; ?></h3>
      <a href="employee_profile_update.php" class="btn">update profile</a>
      <a href="../logout.php" class="delete-btn">logout</a>
      <!-- <div class="flex-btn">
         <a href="../login/login_form.php" class="option-btn">login</a>
         <a href="../login/register.php" class="option-btn">register</a>
      </div> -->
   </div>

</section>

</body>
</html>