<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class arduino_post extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the database library
        $this->load->database();
    }

    public function your_method() {
        // Get current date and time
        $tgl_sekarang = date("ymd");
        $jam_sekarang = date("H:i:s");

        if(!empty($_POST['suhu']) && !empty($_POST['kelembapan']) && !empty($_POST['pH'])) {
            $suhu = $_POST['suhu'];
            $kelembaban = $_POST['kelembaban'];
            $pH = $_POST['pH'];

            // Use CodeIgniter's query builder to insert data
            $data = array(
                'tanggaljam' => date('Y-m-d H:i:s'), // Use the current datetime
                'suhu' => $suhu,
                'pH' => $pH,
                'kelembapan' => $kelembaban
            );

            $this->db->insert('sensor_data', $data);

            if ($this->db->affected_rows() > 0) {
                echo "OK";
            } else {
                echo "Error: " . $this->db->error();
            }
        }
    }
}
