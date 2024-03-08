<?php
    include_once("config.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require ('PHPmailer/Exception.php');
    require ('PHPmailer/SMTP.php');
    require ('PHPmailer/PHPMailer.php');
    // Connection Created Successfully
    $errors = [];
    session_start();
   
//       $_SESSION['message'] = $message;
//                   header('location: otp.php');
//       // Send the email
//       $mail->send()
//       echo 'OTP verification email sent successfully.';
//    else {
//       echo 'OTP verification email could not be sent. Error: ', $mail->ErrorInfo;
//   }

    // // When Sign Up Button Clicked
    // if (isset($_POST['signup'])) {
    //     // $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    //     // $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    //     $email = mysqli_real_escape_string($conn, $_POST['email']);
    //     // $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    //     // check password length if password is less then 8 character so
    //     if (strlen(trim($_POST['password'])) < 8) {
    //         $errors['password'] = 'Use 8 or more characters with a mix of letters, numbers & symbols';
    //     } else {
    //         // if password not matched so
    //         if ($_POST['password'] != $_POST['confirmPassword']) {
    //             $errors['password'] = 'Password not matched';
    //         } else {
    //             $password = md5($_POST['password']);
    //         }
    //     }
    //     // generate a random Code
    //     $code = rand(999999, 111111);
    //     // set Status
    //     $status = "Not Verified";

    //     // echo 'first name = ' .$fname . "<br> last name = " .$lname . "<br> email = " .$email . "<br> password = " .$password . "<br> gender = " .$gender . "<br>";

    //     // check email validation and save information
    //     $sql = "SELECT * FROM user_form WHERE email = '$email'";
    //     $res = mysqli_query($conn, $sql) or die('query failed');
    //     if (mysqli_num_rows($res) > 0) {
    //         $errors['email'] = 'Email is Already Taken';
    //     }

    //     // count erros
    //     if (count($errors) === 0) {
    //         $insertQuery = "INSERT INTO user_form (firstName,lastName,email,password,gender,code,status)
    //         VALUES ('$fname','$lname','$email','$password','$gender',$code,'$status')";
    //         $insertInfo = mysqli_query($conn, $insertQuery);

    //         // Send Varification Code In Gmail
    //         if ($insertInfo) {
    //             // Configure Your Server To Send Mail From Local Host Link In Video Description (How To Config LocalHost Server)
    //             $subject = 'Email Verification Code';
    //             $message = "our verification code is $code";
    //             $sender = 'From: ma382793@gmail.com';

    //             if (mail($email, $subject, $message, $sender)) {
    //                 $message = "We've sent a verification code to your Email <br> $email";

    //                 $_SESSION['message'] = $message;
    //                 header('location: otp.php');
    //             } else {
    //                 $errors['otp_errors'] = 'Failed while sending code!';
    //             }
    //         } else {
    //             $errors['db_errors'] = "Failed while inserting data into database!";
    //         }
    //     }
    // }

    // // if Verify Button Clicked
    // if (isset($_POST['verify'])) {
    //     $_SESSION['message'] = "";
    //     $otp = mysqli_real_escape_string($conn, $_POST['otp']);
    //     $otp_query = "SELECT * FROM user_form WHERE code = $otp";
    //     $otp_result = mysqli_query($conn, $otp_query);

    //     if (mysqli_num_rows($otp_result) > 0) {
    //         $fetch_data = mysqli_fetch_assoc($otp_result);
    //         $fetch_code = $fetch_data['code'];

    //         $update_status = "Verified";
    //         $update_code = 0;

    //         $update_query = "UPDATE user_form SET status = '$update_status' , code = $update_code WHERE code = $fetch_code";
    //         $update_result = mysqli_query($conn, $update_query);

    //         if ($update_result) {
    //             header('location: login.php');
    //         } else {
    //             $errors['db_error'] = "Failed To Insering Data In Database!";
    //         }
    //     } else {
    //         $errors['otp_error'] = "You enter invalid verification code!";
    //     }
    // }

    // // if login Button clicked so

    // if (isset($_POST['login'])) {
    //     $email = mysqli_real_escape_string($conn, $_POST['email']);
    //     $password = md5($_POST['password']);

    //     $emailQuery = "SELECT * FROM user_form WHERE email = '$email'";
    //     $email_check = mysqli_query($conn, $emailQuery);

    //     if (mysqli_num_rows($email_check) > 0) {
    //         $passwordQuery = "SELECT * FROM user_form WHERE email = '$email' AND password = '$password'";
    //         $password_check = mysqli_query($conn, $passwordQuery);
    //         if (mysqli_num_rows($password_check) > 0) {
    //             $fetchInfo = mysqli_fetch_assoc($password_check);
    //             $status = $fetchInfo['status'];
    //             $name = $fetchInfo['firstName'] . " " . $fetchInfo['lastName'];
    //             $_SESSION['name'] = $name;
    //             $_SESSION['email'] = $fetchInfo['email'];
    //             $_SESSION['password'] = $fetchInfo['password'];
    //             if ($status === 'Verified') {
    //                 header('location: main.php');
    //             } else {
    //                 $info = "It's look like you haven't still verify your email $email";
    //                 $_SESSION['message'] = $info;
    //                 header('location: otp.php');
    //             }
    //         } else {
    //             $errors['email'] = 'Password did not matched';
    //         }
    //     } else {
    //         $errors['email'] = 'Invalid Email Address';
    //     }
    // }

    // if forgot button will clicked
    if (isset($_POST['forgot_password'])) {
        $email = $_POST['email'];
        $_SESSION['email'] = $email;

        $emailCheckQuery = "SELECT * FROM employee WHERE email = '$email'";
        $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

        // if query  user_form
        if ($emailCheckResult) {
            // if email matched
            if (mysqli_num_rows($emailCheckResult) > 0) {
                 $code = rand(999999, 111111);
                 $updateQuery = "UPDATE employee SET code = $code, otp_expiry = DATE_ADD(NOW(), INTERVAL 1 MINUTE) WHERE email = '$email'";
                // $updateQuery = "UPDATE employee SET code = $code WHERE email = '$email'";
                $updateResult = mysqli_query($conn, $updateQuery);
                if ($updateResult) {
                    $mail = new PHPMailer();
                    //$code = rand(999999, 111111);
                
                    // Store All Errors user_form
                    $errors = [];
                      // SMTP configuration
                      $mail->isSMTP();
                      $mail->Host = 'smtp.gmail.com';
                      $mail->SMTPAuth = true;
                      $mail->Username = 'prajwalpc84@gmail.com'; // Your email address
                      $mail->Password = 'jwfzmtvhfdxtjxlx'; // Your email password
                      $mail->SMTPSecure = 'tls';
                      $mail->Port = 587;
                  
                      // Sender and recipient information
                      $mail->setFrom('prajwalpc84@gmail.com', 'NEWS KARKALA');
                      $mail->addAddress($email);
                  
                      // Email subject and body
                      $mail->isHTML(true);
                      $mail->Subject = 'Password Reset OTP Verification';
                      $mail->Body = "Your OTP for password reset is: $code<br>Please enter this OTP in the verification form.";
                    $mail->send();
                      $_SESSION['message'] = $message;
                      header('location: verifyEmail.php');
                } else {
                    $errors['db_errors'] = "Failed while inserting data into database!";
                }
            }else{
                $errors['invalidEmail'] = "Invalid Email Address";
            }
        }else {
            $errors['db_error'] = "Failed while checking email from database!";
        }
    }
if(isset($_POST['verifyEmail'])){
    $_SESSION['message'] = "";
    $OTPverify = mysqli_real_escape_string($conn, $_POST['OTPverify']);
    $verifyQuery = "SELECT * FROM employee WHERE code = $OTPverify AND otp_expiry > NOW()";
    $runVerifyQuery = mysqli_query($conn, $verifyQuery);
    if($runVerifyQuery){
        if(mysqli_num_rows($runVerifyQuery) > 0){
            $newQuery = "UPDATE employee SET code = 0 ,otp_expiry=NULL WHERE code=$OTPverify";
            $run = mysqli_query($conn,$newQuery);
            header("location: newPassword.php");
        }else{
            $errors['verification_error'] = "Invalid Verification Code";
        }
    }else{
        $errors['db_error'] = "Failed while checking Verification Code from database!";
    }
}

//resend
// if resend button is clicked
if (isset($_POST['resend_otp'])) {
    $email = $_SESSION['email'];
    $code = rand(999999, 111111);
    $updateQuery = "UPDATE employee SET code = $code, otp_expiry = DATE_ADD(NOW(), INTERVAL 1 MINUTE) WHERE email = '$email'";
    $updateResult = mysqli_query($conn, $updateQuery);
    if ($updateResult) {
        $mail = new PHPMailer();
    
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'prajwalpc84@gmail.com'; // Your email address
        $mail->Password = 'jwfzmtvhfdxtjxlx'; // Your email password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
    
        // Sender and recipient information
        $mail->setFrom('prajwalpc84@gmail.com', 'NEWS KARKALA');
        $mail->addAddress($email);
    
        // Email subject and body
        $mail->isHTML(true);
        $mail->Subject = 'Resend OTP Verification';
        $mail->Body = "Your new OTP for password reset is: $code<br>Please enter this OTP in the verification form.";
    
        $mail->send();
    
        $_SESSION['message'] = "OTP resent successfully.";
        header('location: verifyEmail.php');
    } else {
        $errors['db_errors'] = "Failed while updating data in the database!";
    }
}


// change Password
if(isset($_POST['changePassword'])){
    $password =  mysqli_real_escape_string($conn,$_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn,$_POST['confirmPassword']);
    
    if (strlen($_POST['password']) < 8) {
        $errors['password_error'] = 'Use 8 or more characters with a mix of letters, numbers & symbols';
    } else {
        // if password not matched so
        if ($_POST['password'] != $_POST['confirmPassword']) {
            $errors['password_error'] = 'Password not matched';
        } else {
            $email = $_SESSION['email'];
            $updatePassword = "UPDATE employee SET password = '$password' WHERE email = '$email'";
            $updatePass = mysqli_query($conn, $updatePassword) or die("Query Failed");
           //s session_unset($email);
            session_destroy();
            header('location: login_form.php');
        }
    }
}

//contact

if (isset($_POST['contact'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'prajwalpc84@gmail.com'; // Replace with your email address
        $mail->Password = 'jwfzmtvhfdxtjxlx'; // Replace with your email password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('prajwalpc84@gmail.com', 'NEWS KARKALA'); // Replace with your email address and your name
        $mail->addAddress('kulalprajwal65@gmail.com'); // Replace with the recipient's email address

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Contact Form Submission';
        $mail->Body = "Name: $name<br><br>Email: $email<br><br>Message:$message";

        // Send the email
        $mail->send();

        // Redirect to a success page or display a success message
        header('Location: success.html');
        exit();
    } catch (Exception $e) {
        // Handle the exception if the email could not be sent
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}

//user login
   // if forgot button will clicked
   if (isset($_POST['forgot_password'])) {
    $email = $_POST['email'];
    $_SESSION['email'] = $email;

    $emailCheckQuery = "SELECT * FROM user WHERE email = '$email'";
    $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

    // if query  user_form
    if ($emailCheckResult) {
        // if email matched
        if (mysqli_num_rows($emailCheckResult) > 0) {
             $code = rand(999999, 111111);
             $updateQuery = "UPDATE user SET code = $code, otp_expiry = DATE_ADD(NOW(), INTERVAL 1 MINUTE) WHERE email = '$email'";
            // $updateQuery = "UPDATE employee SET code = $code WHERE email = '$email'";
            $updateResult = mysqli_query($conn, $updateQuery);
            if ($updateResult) {
                $mail = new PHPMailer();
                //$code = rand(999999, 111111);
            
                // Store All Errors user_form
                $errors = [];
                  // SMTP configuration
                  $mail->isSMTP();
                  $mail->Host = 'smtp.gmail.com';
                  $mail->SMTPAuth = true;
                  $mail->Username = 'prajwalpc84@gmail.com'; // Your email address
                  $mail->Password = 'jwfzmtvhfdxtjxlx'; // Your email password
                  $mail->SMTPSecure = 'tls';
                  $mail->Port = 587;
              
                  // Sender and recipient information
                  $mail->setFrom('prajwalpc84@gmail.com', 'NEWS KARKALA');
                  $mail->addAddress($email);
              
                  // Email subject and body
                  $mail->isHTML(true);
                  $mail->Subject = 'Password Reset OTP Verification';
                  $mail->Body = "Your OTP for password reset is: $code<br>Please enter this OTP in the verification form.";
                $mail->send();
                  $_SESSION['message'] = $message;
                  header('location: verifyEmail.php');
            } else {
                $errors['db_errors'] = "Failed while inserting data into database!";
            }
        }else{
            $errors['invalidEmail'] = "Invalid Email Address";
        }
    }else {
        $errors['db_error'] = "Failed while checking email from database!";
    }
}
if(isset($_POST['verifyEmail'])){
$_SESSION['message'] = "";
$OTPverify = mysqli_real_escape_string($conn, $_POST['OTPverify']);
$verifyQuery = "SELECT * FROM user WHERE code = $OTPverify AND otp_expiry > NOW()";
$runVerifyQuery = mysqli_query($conn, $verifyQuery);
if($runVerifyQuery){
    if(mysqli_num_rows($runVerifyQuery) > 0){
        $newQuery = "UPDATE user SET code = 0 ,otp_expiry=NULL WHERE code=$OTPverify";
        $run = mysqli_query($conn,$newQuery);
        header("location: newPassword.php");
    }else{
        $errors['verification_error'] = "Invalid Verification Code";
    }
}else{
    $errors['db_error'] = "Failed while checking Verification Code from database!";
}
}

//resend
// if resend button is clicked
if (isset($_POST['resend_otp'])) {
$email = $_SESSION['email'];
$code = rand(999999, 111111);
$updateQuery = "UPDATE user SET code = $code, otp_expiry = DATE_ADD(NOW(), INTERVAL 1 MINUTE) WHERE email = '$email'";
$updateResult = mysqli_query($conn, $updateQuery);
if ($updateResult) {
    $mail = new PHPMailer();

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'prajwalpc84@gmail.com'; // Your email address
    $mail->Password = 'jwfzmtvhfdxtjxlx'; // Your email password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Sender and recipient information
    $mail->setFrom('prajwalpc84@gmail.com', 'NEWS KARKALA');
    $mail->addAddress($email);

    // Email subject and body
    $mail->isHTML(true);
    $mail->Subject = 'Resend OTP Verification';
    $mail->Body = "Your new OTP for password reset is: $code<br>Please enter this OTP in the verification form.";

    $mail->send();

    $_SESSION['message'] = "OTP resent successfully.";
    header('location: verifyEmail.php');
} else {
    $errors['db_errors'] = "Failed while updating data in the database!";
}
}


// change Password
if(isset($_POST['changePassword'])){
$password =  mysqli_real_escape_string($conn,$_POST['password']);
$confirmPassword = mysqli_real_escape_string($conn,$_POST['confirmPassword']);

if (strlen($_POST['password']) < 8) {
    $errors['password_error'] = 'Use 8 or more characters with a mix of letters, numbers & symbols';
} else {
    // if password not matched so
    if ($_POST['password'] != $_POST['confirmPassword']) {
        $errors['password_error'] = 'Password not matched';
    } else {
        $email = $_SESSION['email'];
        $updatePassword = "UPDATE user SET password = '$password' WHERE email = '$email'";
        $updatePass = mysqli_query($conn, $updatePassword) or die("Query Failed");
       //s session_unset($email);
        session_destroy();
        header('location: login_form.php');
    }
}
}
?>













