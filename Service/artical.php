<?php
// Set up database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nk";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get input data from form
$name3 = $_POST['name3'];
$email3 = $_POST['email3'];
$number = $_POST['number'];
$title = $_POST['title'];
$artical = $_POST['artical'];
$task_type = "artical";
$image = $_FILES['image']['name'];
$image_size = $_FILES['image']['size'];
$image_tmp_name = $_FILES['image']['tmp_name'];
$image_folder = 'artfiles/'.$image;

if ($image_size > 2000000) {
    $error['image'] = 'image size is too large!';
} else {
    move_uploaded_file($image_tmp_name, $image_folder);
}

// Prepare SQL statement to insert data into database
$sql = "INSERT INTO articals (name3, email3, number, title, artical, file, task_type)
VALUES ('$name3', '$email3', '$number', '$title', '$artical', '$image', '$task_type')";

// Execute SQL statement and check for errors
if (mysqli_query($conn, $sql)) {
    // Display success message
    echo "<html>
            <head>
                <meta http-equiv='refresh' content='5;url=bookingx.php'>
                <style>
                    .success-message {
                        width: 100%;
                        max-width: 600px;
                        margin: 20px auto;
                        padding: 20px;
                        background-color: #f9f9f9;
                        border-radius: 10px;
                        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
                        text-align: center;
                        font-size: 24px;
                        font-weight: bold;
                    }
                </style>
            </head>
            <body>
                <div class='success-message'>
                    Success! Your article has been submitted.
                    <br>
                    Redirecting to another page in 5 seconds...
                </div>
            </body>
          </html>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>
