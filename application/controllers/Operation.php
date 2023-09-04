<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operation extends CI_Controller {
	function __construct() {
    parent::__construct();
		if($this->session->userdata('login')===NULL){
			redirect('home');
		}
	}
	public function savedata(){
		if($this->input->is_ajax_request()){
			$index=$this->input->post('index');
			$data=$this->input->post('data');
			$this->session->set_userdata('process_datasetindex',$index);
			$this->session->set_userdata('process_dataset',$data);
		}else{
			show_404();
		}
	}
}
