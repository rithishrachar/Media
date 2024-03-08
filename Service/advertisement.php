<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nk";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the form data
    $name = $_POST["name3"];
    $email = $_POST["email3"];
    $number = $_POST["number"];
    $title = $_POST["title"];
    $artical = $_POST["artical"]; // Corrected key from "artical" to "article"
    $duration = "1 MONTH";
    $amount = "2000";
    $payment_status = "Pending";
    $task_type = "advertisement";
    $payment_mode = $_POST["payment-mode"]; // retrieve the selected radio button value

    // Generate invoice number
    $invoiceNumber = generateInvoiceNumber(); // Assuming you have a function to generate a unique invoice number

    // Calculate expiry date
    $currentDate = date("Y-m-d");
    $expiryDate = date("Y-m-d", strtotime("+1 month"));

    // Check if a file was uploaded
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'adfiles/'.$image;

    if ($image_size > 2000000) {
        $error['image'] = 'image size is too large!';
    } else {
        move_uploaded_file($image_tmp_name, $image_folder);
    }

    // Insert the data into the database
    $sql = "INSERT INTO advertisements (name, email, number, title, artical, file, duration, amount, payment_mode, created_at, expiry_date, payment_status, task_type, invoice_number) 
            VALUES ('$name', '$email', '$number', '$title', '$artical', '$image', '$duration', '$amount', '$payment_mode', '$currentDate', '$expiryDate', '$payment_status', '$task_type', '$invoiceNumber')";

    if ($conn->query($sql) === TRUE) {
        // Calculate remaining days
        $advertisementId = $conn->insert_id;
        $remainingDays = (strtotime($expiryDate) - strtotime($currentDate)) / (60 * 60 * 24);
        // Update remaining days and invoice number in the database
        $updateSql = "UPDATE advertisements SET remaining_days = DATEDIFF('$expiryDate', '$currentDate'), invoice_number = '$invoiceNumber' WHERE no = '$advertisementId'"; // Corrected column name from 'id' to your actual primary key column name
        $conn->query($updateSql);

        // Redirect to the payment page with the generated invoice number
        header("Location: index.php?invoice=$invoiceNumber");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}

// Function to generate a unique invoice number (example implementation)
function generateInvoiceNumber() {
    $prefix = 'INV';
    $randomNumber = mt_rand(100000, 999999);
    $invoiceNumber = $prefix . $randomNumber;
    return $invoiceNumber;
}
?>
