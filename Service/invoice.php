<?php
require('fpdf/fpdf.php');

// retrieve data from database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nk";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 
            a.name, 
            a.email, 
            a.number, 
            a.title, 
            a.duration, 
            a.amount, 
            a.payment_mode,
            c.card_number 
        FROM 
            advertisements AS a 
            JOIN card_details AS c 
                ON a.no = c.no 
        ORDER BY 
            a.created_at DESC, 
            c.created_at DESC 
        LIMIT 1";
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}
$data = $result->fetch_assoc();

$data = $result->fetch_assoc();

// generate invoice PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Name: ');
$pdf->Cell(50, 10, $data['name']);
$pdf->Ln();

$pdf->Cell(40, 10, 'Email: ');
$pdf->Cell(50, 10, $data['email']);
$pdf->Ln();

$pdf->Cell(40, 10, 'Phone: ');
$pdf->Cell(50, 10, $data['number']);
$pdf->Ln();

$pdf->Cell(40, 10, 'Advertisement Title: ');
$pdf->Cell(50, 10, $data['title']);
$pdf->Ln();

$pdf->Cell(40, 10, 'Duration: ');
$pdf->Cell(50, 10, $data['duration'] . ' days');
$pdf->Ln();

$pdf->Cell(40, 10, 'Amount: ');
$pdf->Cell(50, 10, '$' . $data['amount']);
$pdf->Ln();

$pdf->Cell(40, 10, 'Payment Mode: ');
$pdf->Cell(50, 10, $data['payment_mode']);
$pdf->Ln();

$pdf->Cell(40, 10, 'Card Number: ');
$pdf->Cell(50, 10, $data['card_number']);
$pdf->Ln();

$pdf->Output();
$conn->close();
?>
