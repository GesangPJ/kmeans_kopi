<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogsModel extends CI_Model {
    public function getSensorData() {
        $this->output->enable_profiler(TRUE); // Add this line
        $query = $this->db->get();
        // Replace 'kopi' with your database name if necessary
        $this->db->select('no, tanggal, hari, waktu, suhu, kelembaban, ph');
        $this->db->from('logs');
        $this->db->order_by('no', 'desc'); // Optional: Order by date in descending order
        $query = $this->db->get();
        // Return the result as an array of objects
        return $query->result();
    }
}
