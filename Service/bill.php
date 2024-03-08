<?php
// Include the TCPDF library
require_once('tcpdf/tcpdf.php');

// Function to generate and output the PDF
function generatePDF($advertisement, $cardDetails) {
    // Create a new PDF instance
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set the document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('NEWS KARKALA');
    $pdf->SetTitle('Advertisement Invoice');
    $pdf->SetSubject('Invoice Bill');
    $pdf->SetKeywords('Invoice, Bill');

    // Add a page
    $pdf->AddPage();

    

   // Generate the content of the PDF
$html = '
<style>
body {
    font-family: Arial, sans-serif;
    font-size: 12px;
    line-height: 1.5;
    color: #000;
    margin: 20px;
}
h1 {
    font-size: 16px;
    font-weight: bold;
    margin: 0 0 10px 0;
    font-size: 16px;
    font-weight: bold;
    margin: 0 0 10px 0;
    text-align: center;
}
.header h2 {
     font-size: 16px;
    font-weight: bold;
    margin: 0 0 10px 0;
    text-align: right;
    position: absolute;
    top: 20%;
    left: 55%;
    transform: translate(-50%, -50%);

 }
.body h2{
         width: 80%;
         margin: 0 auto; 
}

p {
    margin: 0 0 5px 0;
}
.table {
        width: 80%;
        margin: 0 auto; 
}

.table th, .table td {
    border: 1px solid #000;
    padding: 5px;
}
.table th {
    text-align: left;
}
.table td.total {
    text-align: right;
}
.footer {
    text-align: right;
    padding: 10px 0;
    font-size: 16px;
    font-weight: bold;
    margin: 0 0 10px 0;
    text-align: right;
    position: absolute;
    top: 105%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.pay {
    width: 90%;
   
    margin: 0 auto;
}
.pay th, .pay td {
    border: 1px solid #000;
    padding: 5px;
}
.pay th {
    text-align: left;
}
.pay td.pay {
    text-align: right;
}
.pay h2{
         width: 89%;
         margin: 0 auto; 
}
.header {
    border: 1px solid #ccc;
    padding: 20px;
    max-width: 600px;
    margin: 0 auto;
    background: #f9f9f9;
}
.body {
    border: 1px solid #ccc;
    padding: 20px;
    max-width: 600px;
    margin: 0 auto;
    background: #f9f9f9;
}
.pay {
    border: 1px solid #ccc;
    padding: 20px;
    max-width: 600px;
    margin: 0 auto;
    background: #f9f9f9;
}
.footer {
    border: 1px solid #ccc;
    padding: 20px;
    max-width: 600px;
    margin: 0 auto;
    background: #f9f9f9;
}
.pay  p
{
    font-weight: bold;
   
    font-size: 16px;
    color:firebrick;
    top: 105%;
    left: 50%;
    
}

</style>
<h1> ADVERTISEMENT INVOICE</h1>
<div class="header">
    <!-- Your header content goes here -->
    
<h1>NEWS KARKALA</h1>
    <h2>Invoice Number: ' . $cardDetails['invoice_number'] . '</h2>
</div>
<div class="body">
    <h2>Booking Details</h2>
    <table class="table">
        <tr>
            <th>Name</th>
            <td>' . $advertisement['name'] . '</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>' . $advertisement['email'] . '</td>
        </tr>
        <tr>
            <th>Contact</th>
            <td>' . $advertisement['number'] . '</td>
        </tr>
        <tr>
        <th>Advertisement Type</th>
        <td>' . $advertisement['title'] . '</td>
    </tr>
        <tr>
            <th>Amount</th>
            <td>' . $advertisement['amount'] . '</td>
        </tr>
        <tr>
            <th>Duration</th>
            <td>' . $advertisement['duration'] . '</td>
        </tr>
        
        <tr>
            <th>Booking Date</th>
            <td>' . $advertisement['created_at'] . '</td>
        </tr>
        <tr>
            <th>Booking Expiry Date</th>
            <td>' . $advertisement['expiry_date'] . '</td>
        </tr>
    </table>
</div>
<div class="pay">
    <h2>Payment Details</h2>
    <table class="pay">
        <tr>
            <th>Payment Method</th>
            <td>' . $advertisement['payment_mode'] . '</td>
        </tr>
        <tr>
            <th>Card Holder</th>
            <td>' . $cardDetails['card_holder'] . '</td>
        </tr>
        <tr>
        <th>Card Number</th>
        <td>' . substr($cardDetails['card_number'], -4) . '</td>
    </tr>
    
        <tr>
            <th>Payment Date and Time</th>
            <td>' . $cardDetails['created_at'] . '</td>
        </tr>
        <tr>
            <th>Payment Status</th>
            <td>' . $advertisement['payment_status'] . '</td>
        </tr>
    </table>
    <div class="end">
        <p>Total Amount: ' . $advertisement['amount'] . '</p>
        <p>Payment Status: ' . $advertisement['payment_status'] . '</p>
    </div>
</div>
';

    // Output the HTML content as a PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Set the file name and download options
    $file_name = 'invoice.pdf';
    $pdf->Output($file_name, 'D');
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nk";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




// Retrieve the recently updated advertisement details
$sql = "SELECT * FROM advertisements ORDER BY created_at DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $advertisement = $result->fetch_assoc();
    
    // Retrieve the card details based on the matching invoice number
    $invoiceNumber = $advertisement['invoice_number'];
    $sql = "SELECT * FROM card_details WHERE invoice_number = '$invoiceNumber'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $cardDetails = $result->fetch_assoc();
    }
}
// Check if the download request is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['download_invoice'])) {
    generatePDF($advertisement, $cardDetails);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Invoice Bill</title>
    <!-- Your CSS styles go here -->
    <style>
         /* CSS styles for the invoice bill */
         body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #000;
            margin: 20px;
        }
        h1 {
            font-size: 16px;
            font-weight: bold;
            margin: 0 0 10px 0;
            font-size: 16px;
            font-weight: bold;
            margin: 0 0 10px 0;
            text-align: center;
        }
        .header h2 {
             font-size: 16px;
            font-weight: bold;
            margin: 0 0 10px 0;
            text-align: right;
            position: absolute;
            top: 25%;
            left: 59%;
            transform: translate(-50%, -50%);
           
         }
        .body h2{
                 width: 80%;
                 margin: 0 auto; 
        }

        p {
            margin: 0 0 5px 0;
        }
        .table {
                width: 80%;
                margin: 0 auto; /* Center the table horizontally */
        }

        .table th, .table td {
            border: 1px solid #000;
            padding: 5px;
        }
        .table th {
            text-align: left;
        }
        .table td.total {
            text-align: right;
        }
        .footer {
            text-align: right;
            padding: 10px 0;
            font-size: 16px;
            font-weight: bold;
            margin: 0 0 10px 0;
            text-align: right;
            position: absolute;
            top: 105%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .hello {
                display: block;
                margin: 0 auto;
                /* background-image: url('bgi3.png'); */
                width: 50%;
                height: auto;
        }
        .pay {
            width: 90%;
            /* border-collapse: collapse; */
            margin: 0 auto;
        }
        .pay th, .pay td {
            border: 1px solid #000;
            padding: 5px;
        }
        .pay th {
            text-align: left;
        }
        .pay td.pay {
            text-align: right;
        }
        .pay h2{
                 width: 89%;
                 margin: 0 auto; 
        }
        .header {
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            background: #f9f9f9;
        }
        .body {
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            background: #f9f9f9;
        }
        .pay {
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            background: #f9f9f9;
        }
        .footer {
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            background: #f9f9f9;
        }
        .pay  p
        {
            font-weight: bold;
            /* position: absolute; */
            font-size: 16px;
            color:firebrick;
            top: 105%;
            left: 50%;
            /* transform: translate(-50%, -50%); */
        }

        
        /* button */
        .button {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background-color: rgb(20, 20, 20);
  border: none;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.164);
  cursor: pointer;
  transition-duration: .3s;
  overflow: hidden;
  position: relative;
}

.svgIcon {
  width: 12px;
  transition-duration: .3s;
}

.svgIcon path {
  fill: white;
}

.button:hover {
  width: 140px;
  border-radius: 50px;
  transition-duration: .3s;
  background-color: rgb(255, 69, 69);
  align-items: center;
}

.button:hover .svgIcon {
  width: 50px;
  transition-duration: .3s;
  transform: translateY(60%);
}

.button::before {
  position: absolute;
  top: -20px;
  content: "Download";
  color: white;
  transition-duration: .3s;
  font-size: 2px;
}

.button:hover::before {
  font-size: 13px;
  opacity: 1;
  transform: translateY(30px);
  transition-duration: .3s;
}
.button-container {
  display: flex;
  justify-content: flex-end;
  margin-top: -300px;
   /* Adjust the margin as needed */
}

        </style>

</head>
<body>
    <!-- Your HTML content goes here -->
    <h1>ADVERTISEMENT INVOICE</h1>
    <div class="header">
        <!-- <h1>INVOICE</h1> -->
        <img src="bgi3.png " class="hello">
        <h2>Invoice Number  : <?php echo $cardDetails['invoice_number']; ?></h2>
    </div>
    <div class="body">
        <h2>Booking Details</h2>
        <table class="table">
            <tr>
                <th>Name</th>
                <td><?php echo $advertisement['name']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $advertisement['email']; ?></td>
            </tr>
            <tr>
                <th>Contact</th>
                <td><?php echo $advertisement['number']; ?></td>
            </tr>
            <tr>
                <th>Advertisement Type</th>
                <td><?php echo $advertisement['title']; ?></td>
            </tr>
            <tr>
                <th>Amount</th>
                <td><?php echo $advertisement['amount']; ?></td>
            </tr>
            <tr>
                <th>Duration</th>
                <td><?php echo $advertisement['duration']; ?></td>
            </tr>
            
            <tr>
                <th>Booking Date</th>
                <td><?php echo $advertisement['created_at']; ?></td>
            </tr>
            <tr>
                <th>Booking Expiry Date</th>
                <td><?php echo $advertisement['expiry_date']; ?></td>
            </tr>
        </table>
    </div>
    <div class="pay">
        <h2>Payment Details</h2>
        <table class="pay">
        <tr>
                <th>Payment Method</th>
                <td><?php echo $advertisement['payment_mode']; ?></td>
            </tr>
        <tr>
                <th>Card Holder</th>
                <td><?php echo $cardDetails['card_holder']; ?></td>
            </tr>
            <tr>
                <!-- <th>Card Number</th> -->
                
    <th>Card Number</th>
    <td><?php echo '**** **** *** ' . substr($cardDetails['card_number'], -4); ?></td>

            </tr>
            <tr>
                <th>Payment Date and Time</th>
                <td><?php echo $cardDetails['created_at']; ?></td>
            </tr>
            <tr>
                <th>Payment Status</th>
                <td><?php echo $advertisement['payment_status']; ?></td>
            </tr>
        </table>
        <div class="end">
        <p>Total Amount  : <?php echo $advertisement['amount']; ?></p>
        <p>Payment Status: <?php echo $advertisement['payment_status']; ?></p>
        </div>
        
</div>
<div>
    <center><p>This is a Computer Generated Bill...No Signature is Required.</P></center>
</div>
<div class="button-container">
<h1 style="color: blue;">Please click download button to get your invoice.</h1>

    <button class="button"> 
        <svg viewBox="0 0 16 16" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="svgIcon">
            <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z"></path>
        </svg>
    </button>
</div>

    <form id="download-form" method="POST" style="display: none;">
        <input type="hidden" name="download_invoice" value="1">
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var button = document.querySelector('.button');
        button.addEventListener('click', function() {
            // Submit the form to trigger the download
            var form = document.querySelector('#download-form');
            form.submit();
        });
    });
    </script>

</body>
</html>
