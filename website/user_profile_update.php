<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:../login/login_form.php');
};

if(isset($_POST['update'])){

   $fname = $_POST['firstName'];
   $fname = filter_var($fname, FILTER_SANITIZE_STRING);
   $lname = $_POST['lastName'];
   $lname = filter_var($lname, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   // Validate first name and last name
   // if(!preg_match("/^[a-zA-Z]+$/", $fname)){
   //    $message[] = 'First name should only contain letters.';
   // }
   // if(!preg_match("/^[a-zA-Z]+$/", $lname)){
   //    $message[] = 'Last name should only contain letters.';
   // }
   

   $update_profile = $conn->prepare("UPDATE `user` SET firstName = ?, lastName = ?, email = ?, address = ? WHERE id = ?");
   $update_profile->execute([$fname, $lname, $email, $address,  $user_id]);

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_size = $_FILES['image']['size'];
   $image_folder = '../login/user_img/'.$image;

   if(!empty($image)){

      if($image_size > 2000000){
         $message[] = 'Image size is too large.';
      } else {

         // Check if the uploaded file has the same name as the existing image
         if ($image === $old_image) {
            $message[] = 'Image with the same name already exist. Please choose a different image file.';
         } else {
            $update_image = $conn->prepare("UPDATE `user` SET pic = ? WHERE id = ?");
            $update_image->execute([$image, $user_id]);

            if($update_image){
               move_uploaded_file($image_tmp_name, $image_folder);
               $old_image_path = '../login/user_img/' . $old_image;
               if (file_exists($old_image_path)) {
                  unlink($old_image_path);
               }
               $message[] = 'Image has been updated!';
            }
         }
      }
   }

   $old_pass = $_POST['old_pass'];
   $previous_pass = $_POST['previous_pass'];
   $previous_pass = filter_var($previous_pass, FILTER_SANITIZE_STRING);
   $new_pass = $_POST['new_pass'];
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = $_POST['confirm_pass'];
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);
   
   if (!empty($previous_pass) || !empty($new_pass) || !empty($confirm_pass)) {
      if ($previous_pass !== $old_pass) {
         $message[] = 'Old password does not match!';
      } elseif ($new_pass !== $confirm_pass) {
         $message[] = 'Confirm password does not match!';
      } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=!])(?=.*[^\w]).{8,}$/", $new_pass)) {
         $message[] = 'New password should contain at least one uppercase letter, one lowercase letter, one digit, and one special character.';
      } else {
         $update_password = $conn->prepare("UPDATE `user` SET password = ? WHERE id = ?");
         $update_password->execute([$new_pass, $user_id]);
         $message[] = 'Password has been updated!';
      }
   }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>User profile update</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>
 <!-- Navigation Bar -->
 <nav class="navbar">
   <ul class="navbar-items">
      <li class="navbar-item">
         <a href="../Service/bookingx.php" class="navbar-link">Home</a>
      </li>
    
      <li class="navbar-item">
         <a href="../logout.php" class="navbar-link">Logout</a>
      </li>
   </ul>
</nav>
<h1 class="title"> Update <span>User</span> Profile </h1>

<section class="update-profile-container">

   <?php
      $select_profile = $conn->prepare("SELECT * FROM `user` WHERE id = ?");
      $select_profile->execute([$user_id]);
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="../login/user_img/<?= $fetch_profile['pic']; ?>" alt="">
      <div class="flex">
         <div class="inputBox">
            <span>Firstname:</span>
            <input type="text" name="firstName" required class="box" placeholder="Enter your first name" value="<?= $fetch_profile['firstName']; ?>"pattern="[A-Za-z ]+" title="Only characters are allowed">
            <span>Lastname:</span>
            <input type="text" name="lastName" required class="box" placeholder="Enter your last name" value="<?= $fetch_profile['lastName']; ?>"pattern="[A-Za-z ]+" title="Only characters are allowed">
            <span>Email:</span>
            <input type="email" name="email" required class="box" placeholder="Enter your email" value="<?= $fetch_profile['email'] ?? ''; ?>" readonly>
            <span>Address:</span>
            <input type="text" name="address" required class="box" placeholder="Enter your address" value="<?= $fetch_profile['address'] ?? ''; ?>">
            <input type="hidden" name="old_image" value="<?= $fetch_profile['pic']; ?>">

            <span>Profile pic:</span>
            <img src="../login/user_img/<?= $fetch_profile['pic']; ?>" alt="">
            <!-- <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png"> -->
            <input type="file" name="image"class="box" accept="image/jpg, image/jpeg, image/png, image/pdf, image/document, image/docx" onblur="validateFileInput()" required/>

         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?= $fetch_profile['password']; ?>">
            <span>Old Password:</span>
            <input type="password" class="box" name="previous_pass" placeholder="Enter previous password">
            <span>New Password:</span>
            <input type="password" class="box" name="new_pass" placeholder="Enter new password">
            <span>Confirm Password:</span>
            <input type="password" class="box" name="confirm_pass" placeholder="Confirm new password">
         </div>
      </div>
      <div class="flex-btn">
         <input type="submit" value="UPDATE PROFILE" name="update" class="btn">
         <a href="user_page.php" class="option-btn">Go back</a>
      </div>
   </form>

</section>
<script>
        function validateFileInput(fileInput) {
  // Get the file name.
  var file = fileInput.value;

  // Check if the file name already exists in the list of existing files.
  var existingFiles = document.getElementById("existingFiles").files;
  for (var i = 0; i < existingFiles.length; i++) {
    if (existingFiles[i].name === image) {
      // The file name already exists.
      return false;
    }
  }

  // The file name does not exist.
  return true;
}


    </script>  

</body>
</html>
