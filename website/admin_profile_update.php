<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:../login/login_form.php');
};

if(isset($_POST['update'])){

   $fname = $_POST['firstName'];
   $fname = filter_var($fname, FILTER_SANITIZE_STRING);
   $lname = $_POST['lastName'];
   $lname = filter_var($lname, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   // Validate first name and last name
   // if(!preg_match("/^[a-zA-Z]+$/", $fname)){
   //    $message[] = 'First name should only contain letters.';
   // }
   // if(!preg_match("/^[a-zA-Z]+$/", $lname)){
   //    $message[] = 'Last name should only contain letters.';
   // }
   
   $update_profile = $conn->prepare("UPDATE `employee` SET firstName = ?,lastName=?, email = ? WHERE id = ?");
   $update_profile->execute([$fname,$lname, $email, $admin_id]);

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_size = $_FILES['image']['size'];
   $image_folder = '../process/admin_pic/'.$image;

   if(!empty($image)){

      if($image_size > 2000000){
         $message[] = 'image size is too large';
      }else{
         $update_image = $conn->prepare("UPDATE `employee` SET pic = ? WHERE id = ?");
         $update_image->execute([$image, $admin_id]);

         if($update_image){
            move_uploaded_file($image_tmp_name, $image_folder);
            unlink('../process/admin_pic/' . $old_image);
            $message[] = 'image has been updated!';
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
         $message[] = 'old password not matched!';
      } elseif ($new_pass !== $confirm_pass) {
         $message[] = 'confirm password not matched!';
      } else {
         $update_password = $conn->prepare("UPDATE `employee` SET password = ? WHERE id = ?");
         $update_password->execute([$new_pass, $admin_id]);
         $message[] = 'password has been updated!';
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

   <title>admin profile update</title>

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
         <a href="../admin/dashboard.php" class="navbar-link">Home</a>
      </li>
    
      <li class="navbar-item">
         <a href="../logout.php" class="navbar-link">Logout</a>
      </li>
   </ul>
</nav>
<h1 class="title"> update <span>admin</span> profile </h1>

<section class="update-profile-container">

   <?php
      $select_profile = $conn->prepare("SELECT * FROM `employee` WHERE id = ?");
      $select_profile->execute([$admin_id]);
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="../process/admin_pic/<?= $fetch_profile['pic']; ?>" alt="">
      <div class="flex">
         <div class="inputBox">
            <span>Firstname : </span>
            <input type="text" name="firstName" required class="box" placeholder="enter your name" value="<?= $fetch_profile['firstName']; ?>" pattern="[A-Za-z ]+" title="Only characters are allowed">
            <span>Lastname : </span>
            <input type="text" name="lastName" required class="box" placeholder="enter your name" value="<?= $fetch_profile['lastName']; ?>"pattern="[A-Za-z ]+" title="Only characters are allowed">
            <span>Email : </span>
            <input type="email" name="email" required class="box" placeholder="enter your email" value="<?= $fetch_profile['email'] ?? ''; ?>" readonly>
            <input type="hidden" name="old_image" value="<?= $fetch_profile['pic']; ?>">

            <span>Profile pic : </span>
            <img src="../process/admin_pic/<?= $fetch_profile['pic']; ?>" alt="">
            <!-- <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png"> -->
            <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/pdf, image/document, image/docx" onblur="validateFileInput()" />
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?= $fetch_profile['password']; ?>">
            <span>Old Password :</span>
            <input type="password" class="box" name="previous_pass" placeholder="enter previous password" >
            <span>New Password :</span>
            <input type="password" class="box" name="new_pass" placeholder="enter new password" >
            <span>Confirm Password :</span>
            <input type="password" class="box" name="confirm_pass" placeholder="confirm new password" >
         </div>
      </div>
      <div class="flex-btn">
         <input type="submit" value="UPDATE PROFILE" name="update" class="btn">
         <a href="admin_page.php" class="option-btn">go back</a>
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