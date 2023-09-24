<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportData extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load the default database
    }

    public function index() {
        // Create a new spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'tanggaljam');
        $sheet->setCellValue('B1', 'suhu');
        $sheet->setCellValue('C1', 'pH');
        $sheet->setCellValue('D1', 'kelembaban');
        $sheet->setCellValue('E1', 'kondisi');

        // Fetch data from your database (selecting only the desired columns)
        $query = $this->db->get('sensor_data'); // 'sensor_data' is your table name

        // Assuming 'id' is the name of the primary key column in your database table
        $excludeColumns = ['id'];

        if ($query->num_rows() > 0) {
            $row = 2;
            foreach ($query->result() as $row_data) {
                $col = 'A'; // Start from column A for both header and data
                foreach ($row_data as $key => $value) {
                    // Check if the column name should be excluded
                    if (!in_array($key, $excludeColumns)) {
                        $sheet->setCellValue($col++ . $row, $value);
                    }
                }
                $row++;
            }
        } else {
            // No data available
            $sheet->setCellValue('A2', 'No data available.');
        }


        // Create a new Xlsx writer
        $writer = new Xlsx($spreadsheet);

        // Set the header and file format
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="sensordata.xlsx"');

        // Save the Excel file to output
        $writer->save('php://output');
    }
}
?>