<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct() {
        parent::__construct();

    }
	public function login(){
        $data = array(
            "user_name"=>$this->input->post("user_name"),
            "user_password"=>$this->input->post("user_password")
        );
				if($data['user_name']=="admin"&&$data['user_password']=="admin"){
					$data['login'] = true;
					$this->session->set_userdata('login', $data);
					redirect("kmeanselbow");
				}
        redirect("home");
    }
		public function logout(){
			$this->session->sess_destroy();
			redirect("home");
		}
}
#