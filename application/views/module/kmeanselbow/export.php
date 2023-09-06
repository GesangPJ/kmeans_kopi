<?php
require 'PHPExcel/Classes/PHPExcel.php';

// Create a new PHPExcel object
$objPHPExcel = new PHPExcel();

// Connect to your database (replace with your database credentials)
$servername = "localhost";
$username = "gesangpj";
$password = "Gesang_0110";
$dbname = "kopi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from your database (selecting only the desired columns)
$sql = "SELECT tanggaljam, suhu, pH, kelembapan FROM sensor_data"; // Replace 'your_table' with your actual table name
$result = $conn->query($sql);

// Create a new worksheet
$objPHPExcel->setActiveSheetIndex(0);
$sheet = $objPHPExcel->getActiveSheet();

// Set headers
$sheet->setCellValue('A1', 'tanggaljam');
$sheet->setCellValue('B1', 'Suhu');
$sheet->setCellValue('C1', 'pH');
$sheet->setCellValue('D1', 'Kelembaban');

if ($result->num_rows > 0) {
    $row = 2;
    while ($row_data = $result->fetch_assoc()) {
        $col = 'A';
        foreach ($row_data as $value) {
            // Exclude the "No." column from being added to the Excel sheet
            $sheet->setCellValue($col++ . $row, $value);
        }
        $row++;
    }
} else {
    // No data available
    $sheet->setCellValue('A2', 'No data available.');
}

// Set the header and file format
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="sensordata.xlsx"');

// Save the Excel file to output
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

// Close the database connection
$conn->close();
?>