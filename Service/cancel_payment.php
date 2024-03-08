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

// check if invoice number is provided
if (isset($_POST['invoice_number'])) {
    $invoiceNumber = $_POST['invoice_number'];

    // Prepare and execute SQL statements to delete rows
    $deleteAdSql = "DELETE FROM advertisements WHERE invoice_number = '$invoiceNumber'";
    $deleteCardSql = "DELETE FROM card_details WHERE invoice_number = '$invoiceNumber'";

    $success = false;

    if ($conn->query($deleteAdSql) === TRUE && $conn->query($deleteCardSql) === TRUE) {
        $success = true;
    }

    // Send response as JSON
    header('Content-type: application/json');
    echo json_encode(['success' => $success]);

    exit;
}

$conn->close();
?>
