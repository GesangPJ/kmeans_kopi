<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class KmeansElbow extends CI_Controller {
  
    var $footer = [];
    var $menu = [];
	function __construct() {
    parent::__construct();
    $this->load->database();
    if($this->session->userdata('login')===NULL){
      redirect('home');
    }
    $this->footer = array(
                            "copyright"=>"xxx",
                            "aboutus"=>"#LinktoYour",
                            "contactus"=>"#LinktoContact",
                            "help"=>"#LinktoHelp"
                        );
    $this->menu = array(
                    "navbar"=>array(
                            "menu"=>array(
                                            array(
                                            "name"=>"Dashboard",
                                            "icon"=>"remixicon-dashboard-line",
                                            "link"=>base_url()."kmeanselbow"
                                        ),
                                        array(
                                            "name"=>"K-Means Elbow",
                                            "icon"=>"remixicon-honour-line",
                                            "link"=>base_url()."kmeanselbow/process"
                                        ),
                                        array(
                                            "name"=>"Logout",
                                            "icon"=>"remixicon-honour-line",
                                            "link"=>base_url()."auth/logout"
                                        )
                            )
                        )
                    );
	}
	public function index()
	{
        $var['menu'] = $this->menu;
        $var['module'] = "kmeanselbow/dashboard";
        $var['var_module'] = array();
        $var['content_title'] = "Sensor Data";
        $var['breadcrumb'] = array(
                "Home"=>"",
                "Dashboard"=>"active"
        );
        $var['footer'] = $this->footer;
        $this->load->view('main',$var);
  }
  public function delete_sensor_data() {
    $id = $this->input->post('id');
    $this->load->model('KmeansElbow_model');
    
    if ($this->KmeansElbow_model->deleteSensorData($id)) {
        echo "success";
    } else {
        echo "error";
    }
  }
  public function post_arduino() {
    // Get current date and time
    $tgl_sekarang = date("ymd");
    $jam_sekarang = date("H:i:s");

    if(!empty($_POST['suhu']) && !empty($_POST['kelembaban']) && !empty($_POST['pH'])) {
        $suhu = $_POST['suhu'];
        $kelembaban = $_POST['kelembaban'];
        $pH = $_POST['pH'];

        // Use CodeIgniter's query builder to insert data
        $data = array(
            'tanggaljam' => date('Y-m-d H:i:s'), // Use the current datetime
            'suhu' => $suhu,
            'pH' => $pH,
            'kelembaban' => $kelembaban
        );

        $this->db->insert('sensor_data', $data);

        if ($this->db->affected_rows() > 0) {
            echo "OK";
        } else {
            echo "Error: " . $this->db->error();
        }
    }
}
  public function about()
	{
        $var['menu'] = $this->menu;
        $var['module'] = "kmeanselbow/about";
        $var['var_module'] = array();
        $var['content_title'] = "Tentang Aplikasi";
        $var['breadcrumb'] = array(
                "Home"=>"",
                "Dashboard"=>"active"
        );
        $var['footer'] = $this->footer;
        $this->load->view('main',$var);
  }
public function process($page="dataset")
    {
        $var['menu'] = $this->menu;
        $var['module'] = "kmeanselbow/process";
        $var['var_module'] = array("page"=>$page);
        $var['content_title'] = "Metode K-Means Elbow";
        $var['breadcrumb'] = array(
                "Home"=>"",
                "K-Means Elbow"=>"active"
        );
        $var['footer'] = $this->footer;
        $this->load->view('main',$var);
    }
    // Debug Test Data
  function debug(){
    $data = array([0,0,0.0909091,0],[0.0842349,0.147541,0.454545,0.117647],[0.115147,0.163934,0.0909091,0.147059],[0.183153,0.245902,0.181818,0.205882],[0.357032,0.311475,0.454545,0.294118],[0.454405,0.42623,0.727273,0.470588],[0.51391,0.52459,0.909091,0.470588],[0.526275,0.278689,0.0909091,0.558824],[0.608964,0.622951,0.636364,0.558824],[0.62983,0.672131,0.636364,0.676471],[0.632921,0.557377,0.545455,0.588235],[0.656878,0.655738,0.636364,0.617647],[0.66847,0.540984,0.818182,0.735294],[0.688563,0.754098,0.636364,0.647059],[0.693972,0.57377,0.727273,0.735294],[0.698609,0.672131,0.545455,0.647059],[0.7017,0.704918,0.636364,0.676471],[0.724111,0.672131,0.727273,0.735294],[0.727975,0.721311,0.545455,0.676471],[0.77357,0.770492,1,0.705882],[0.782071,0.704918,0,0.735294],[0.800618,1,0.727273,0.823529],[0.802164,0.786885,0.818182,0.764706],[0.804482,0.918033,0.727273,0.823529],[0.812983,0.754098,0.818182,0.794118],[0.822257,0.967213,0.454545,0.911765],[0.867852,0.606557,0.454545,0.823529],[0.925039,0.918033,0.454545,0.882353],[0.938176,1,0.636364,0.882353],[1,0.967213,0.636364,1]);
    $this->kmeanselbow->init($data,3,'rata-rata');
    $this->kmeanselbow->execute();
    echo "<pre>";
    print_r($this->kmeanselbow->getprocess());
    echo "</pre>";
  }
}
