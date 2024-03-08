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
$name1 = $_POST['name1'];
$email1 = $_POST['email1'];
$ev_date = $_POST['ev_date'];
$ev_name = $_POST['ev_name'];
$number = $_POST['number'];
$address = $_POST['address'];
$pincode = $_POST['pincode'];
$task_type = "youtube";

// Prepare SQL statement to insert data into database
$sql = "INSERT INTO youtube (name1, email1, ev_date, ev_name, number, address, pincode,task_type)
VALUES ('$name1', '$email1', '$ev_date', '$ev_name', '$number', '$address', '$pincode','$task_type')";

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
                    Success! Your YOUTUBE STREAMING service has been Booked Sucessfully.
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
