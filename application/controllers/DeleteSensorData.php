<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DeleteSensorData extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Load the database library
        $this->load->database();
    }

    public function index() {
        $id = $this->input->post('id');
        $this->load->model('KmeansElbow_model');
        
        if ($this->KmeansElbow_model->deleteSensorData($id)) {
            echo "success";
        } else {
            echo "error";
        }
      }
}