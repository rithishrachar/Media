<?php
@include 'config.php';

if(isset($_POST['submit'])){

   $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
   $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
   // $number = mysqli_real_escape_string($conn,$_POST['number']);
   $address = mysqli_real_escape_string($conn,$_POST['address']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = mysqli_real_escape_string($conn, $_POST['number']);
   $pass = mysqli_real_escape_string($conn,$_POST['password']);
   $cpass = mysqli_real_escape_string($conn,$_POST['cpassword']);
   $degree = "user";
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'user_img/'.$image;

   $error = array(); // Initialize error array

   // Check if email already exists
   $select = "SELECT * FROM user WHERE email = '$email' && password = '$pass'";
   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $error['email'] = 'User already exists!';
   }

   // Check if password and confirm password match
   if($pass != $cpass){
      $error['password'] = 'Passwords do not match!';
   }

   // Check password strength
   $uppercase = preg_match('@[A-Z]@', $pass);
   $lowercase = preg_match('@[a-z]@', $pass);
   $number    = preg_match('@[0-9]@', $pass);
   $specialChars = preg_match('@[^\w]@', $pass);

   if(!$uppercase){
      $error['password'] = 'Password should include at least one uppercase letter.';
   }
   if(!$lowercase){
      $error['password'] = 'Password should include at least one lowercase letter.';
   }
   if(!$number){
      $error['password'] = 'Password should include at least one number.';
   }
   if(!$specialChars){
      $error['password'] = 'Password should include at least one special character.';
   }
   if(strlen($pass) < 8) {
      $error['password'] = 'Password should be at least 8 characters in length.';
   }
   // Check if name contains only characters and no numbers
//    if(!preg_match('/^[a-zA-Z\s]+$/', $name)) {
//       $error['name'] = 'Name should contain only letters and spaces.';
//   }
  // Check if first name contains only characters and no numbers or special characters
if(!preg_match('/^[a-zA-Z]+$/', $firstName)) {
   $error['firstName'] = 'First name should contain only letters.';
}

// Check if last name contains only characters and no numbers or special characters
if(!preg_match('/^[a-zA-Z]+$/', $lastName)) {
   $error['lastName'] = 'Last name should contain only letters.';
}
// Check if email contains '@' symbol
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
   $error['email'] = 'Email should contain the @ symbol.';
}

if($image_size > 2000000){
   $error['image'] = 'image size is too large!';
}else{
   move_uploaded_file($image_tmp_name, $image_folder);
}
   // If no errors, insert data into database
   if(count($error) == 0) {
      $insert = "INSERT INTO user(firstName,lastName,address, email, password, degree,pic) VALUES('$firstName','$lastName','$address','$email','$pass','$degree','$image')";
      mysqli_query($conn, $insert);
      header('location:login_form.php');
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form</title>

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="stylenn2.css">

</head>
<body>
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
   <form action="" enctype="multipart/form-data" method="post">
      <h3>REGISTRATION</h3>
      <?php
      if(isset($error)){
         foreach($error as $key => $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
     <label for="firstName">First Name</label><span id="message1">*</span>
	<input type="text" id="firstName" name="firstName" class="form-control" onblur="validateName()" placeholder="Enter First Name" required>

   <label for="lastName">Last Name</label><span id="message2">*</span>
	<input type="text" id="lastName" name="lastName" class="form-control" onblur="validateName()" placeholder="Enter Last Name" required>

      <!-- <input type="text" name="number"  placeholder="Enter contact number" required> -->
      <label for="address">Address</label>

      <input type="text" name="address"  placeholder="Enter your address" required>
      <label for="mobile">Mobile</label><span id="message4"> *</span>
		<input type="text" id="number" name="number"class="form-control" placeholder="Ex:1234567890" required>
      <label for="email">Email Address</label><span id="message3">*</span>

      <!-- <input type="email" name="email"  placeholder="Enter your email" required> -->
      <input type="email" id="email" name="email"class="form-control" placeholder="example@gmail.com" onblur="validateEmail()" required>
      <!-- <label for="password">Password</label><span>*</span> -->
      <label for="password">Password</label><span id="password-validation">*</span>


      <input type="password" id="password" name="password" placeholder="Enter your password" oninput="checkPasswordMatch()" required>
      <label for="password">Confirm Password</label><span id="password-match">*</span>


      <input type="password" id="confirmPassword" name="cpassword" placeholder="Confirm your password" oninput="checkPasswordMatch()" required>

      <label for="image">Upload Image</label><span>*</span>

      <input type="file" id="image" name="image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>Have an account? <a href="login_form.php">login</a></p>
</div>    
<script src="script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var validateEmail = function(elementValue) {
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return emailPattern.test(elementValue);
    }

    $('#email').keyup(function() {
        var value = $(this).val();
        var valid = validateEmail(value);

        if (!valid) {
            $('#message3').html(' Enter the proper email format').css('color', 'red');
            $("#submit").prop('disabled', true);
        } else {
            $('#message3').html(' *').css('color', 'green');
            $("#submit").prop('disabled', false);
        }
    });

    $('#number').on('keyup', function() {
        if ($('#number').val().length == 10) {
            $('#message4').html(' *').css('color', 'green');
        } else {
            $('#message4').html(' Enter 10 digits').css('color', 'red');
        }
    });

    var validateName = function(elementValue) {
        var namePattern = /^[a-zA-Z ]+$/;
        return namePattern.test(elementValue);
    }

    $('#firstName').keyup(function() {
        var value = $(this).val();
        var valid = validateName(value);

        if (!valid) {
            $('#message1').html(' First Name should be in proper format').css('color', 'red');
            $("#submit").prop('disabled', true);
        } else {
            $('#message1').html(' *').css('color', 'green');
            $("#submit").prop('disabled', false);
        }
    });

    $('#lastName').keyup(function() {
        var value = $(this).val();
        var valid = validateName(value);

        if (!valid) {
            $('#message2').html(' Last Name should be in proper format').css('color', 'red');
            $("#submit").prop('disabled', true);
        } else {
            $('#message2').html(' *').css('color', 'green');
            $("#submit").prop('disabled', false);
        }
    });
    var validatePassword = function(elementValue) {
  var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
  var valid = passwordPattern.test(elementValue);
  var errors = [];

  if (elementValue.length < 8) {
    errors.push('Password should be at least 8 characters in length.');
  }

  if (!/(?=.*[a-z])/.test(elementValue)) {
    errors.push('Password should contain at least one lowercase letter.');
  }

  if (!/(?=.*[A-Z])/.test(elementValue)) {
    errors.push('Password should contain at least one uppercase letter.');
  }

  if (!/(?=.*\d)/.test(elementValue)) {
    errors.push('Password should contain at least one digit.');
  }

  if (!/(?=.*[@$!%*?&])/.test(elementValue)) {
    errors.push('Password should contain at least one special character.');
  }

  if (errors.length > 0) {
    $("#password-validation").html(errors.join(' ')).css('color', 'red');
  } else {
    $("#password-validation").empty();
  }

  return valid;
}



function checkPasswordMatch() {
  var password = $("#password").val();
  var confirmPassword = $("#confirmPassword").val();

  if (password === confirmPassword) {
    $("#password-match").html('Passwords match.').css('color', 'green');
    $("#submit").prop('disabled', !validatePassword(password));
  } else {
    $("#password-match").html('Passwords do not match.').css('color', 'red');
    $("#submit").prop('disabled', true);
  }
}

</script>
</body>
</html>
