<?php
// connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nk";
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // retrieve form data
    $card_number = $_POST['card_number'];
    $card_holder = $_POST['card_holder'];
    $expiration_month = $_POST['expiration_month'];
    $expiration_year = $_POST['expiration_year'];
    $cvv = $_POST['cvv'];
    $invoice_number = $_POST['invoice_number'];

    // prepare and execute SQL statement to insert data into table
    $sql = "INSERT INTO card_details (card_number, card_holder, expiration_month, expiration_year, cvv, invoice_number) 
            VALUES ('$card_number', '$card_holder', '$expiration_month', '$expiration_year', '$cvv', '$invoice_number')";

    if ($conn->query($sql) === TRUE) {
        // Update payment status for the recently created row
        $updateSql = "UPDATE advertisements SET payment_status = 'Successful' WHERE invoice_number = '$invoice_number'";
        $conn->query($updateSql);
        // redirect to success page

        header("refresh:3; url=paysuccess.php"); // Redirect to success page after 5 seconds
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
