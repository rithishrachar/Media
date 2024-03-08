<?php
$fileName = $_POST['filename']; // Get the file name from the AJAX request

$targetDirectory = 'artfiles/'; // Directory where files are uploaded
$filePath = $targetDirectory . $fileName;

$response = array();
$response['exists'] = file_exists($filePath);

echo json_encode($response);
?>
