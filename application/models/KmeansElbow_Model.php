<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class KmeansElbow_Model extends CI_Model {
  var $data = array();
  var $cluster = [];
  var $maxloop = 10;
  var $jmlcentroid = 0;
  var $dimensi = 0;
  var $centroid = 0;
  var $centroid_allof;
  var $data_cluster = [];
  var $distance = [];
  function __construct() {
      parent::__construct();
      $this->load->database();
  }
  public function getSensorData() {
    $this->db->select('id, tanggaljam, suhu, pH, kelembaban');
    $this->db->from('sensor_data');
    $this->db->order_by('id', 'asc');
    $query = $this->db->get();
    return $query->result();
  }
  public function deleteSensorData($id) {
    // Delete a specific record from the 'sensor_data' table based on the 'id'
    $this->db->where('id', $id);
    $this->db->delete('sensor_data');

    return ($this->db->affected_rows() > 0);
  }
  public function deleteAllSensorData() {
    // Perform the deletion query
    $this->db->empty_table('sensor_data');

    // Check if the deletion was successful
    if ($this->db->affected_rows() > 0) {
        return true;
    } else {
        return false;
    }
  }
  public function init($data = NULL,$jmlcentroid = 0,$centroid = NULL,$maxloop = 10){
    $this->data = $data;
    $this->cluster = [];
    $this->maxloop = $maxloop;
    $this->jmlcentroid = $jmlcentroid;
    $this->dimensi = sizeof($this->data[0]);
    if($centroid == 'rata-rata'){
      $this->centroid = $this->centroid_rata_rata();
    }else if($centroid == 'random'){
      $this->centroid = $this->centroid_random();
    }else if($centroid == 'custom'){
      $this->centroid = $this->centroid_custom();
    }else if($centroid == 'fill'){
      $this->centroid = $this->centroid_fill();
    }else{
      if(is_array($centroid)){
        $this->centroid = $centroid;
      }else{
        throw new Exception('Exception : Centroid Tidak Valid.');
      }
    }
    $this->centroid_allof=[];
    $this->data_cluster = [];
    $this->distance = [];
  }
  public function getprocess(){
    return array("centroid"=>$this->centroid_allof,"distance"=>$this->distance,"cluster"=>$this->cluster);
  }
  public function elbow_optimize($data=[],$maxcluster=2,$maxloop=10,$centroid = NULL){
    $hasil=array();
    $result=array();
    $process=array();
    for ($cluster=2;$cluster<=$maxcluster;$cluster++) {
      $this->init($data,$cluster,'rata-rata',$maxloop,$centroid);
      $this->execute();
      $output = $this->getprocess();
      $cluster_acuan = $output['cluster'][(sizeof($output['cluster'])-1)];
      $centroid_acuan = $output['centroid'][(sizeof($output['centroid'])-1)];
      $temp2=array();
      $process2=array();
      foreach ($cluster_acuan as $key => $value) {
        $temp1=array();
        $process1=array();
        $process1[]="Cluster - ".$cluster;
        foreach ($data[$key] as $i=>$keys) {
          $temp1[]=pow(($keys-$centroid_acuan[$value][$i]),2);
          $process1[]="(".$keys." - ".$centroid_acuan[$value][$i].")^2";
        }
        $temp2[]=array_sum($temp1);
        $process1[]=array_sum($temp1);
        $process2[]=$process1;
      }
      $hasil[]=array("cluster"=>$cluster,"hasil"=>array_sum($temp2));
      $process[]=$process2;
    }
    $x=0;
    foreach ($hasil as $key) {
      if($x==0){
        $result[]=array("cluster"=>$key['cluster'],"nilai"=>$key['hasil'],"selisih"=>$key['hasil']);
      }else{
        $result[]=array("cluster"=>$key['cluster'],"nilai"=>$key['hasil'],"selisih"=>abs($key['hasil']-$hasil[$x-1]['hasil']));
      }
      $x++;
    }
    return array("process"=>$process,"hasil"=>$result);

  }
  public function execute(){
    for($i=0;;$i++){
        $this->cluster[$i] = array();
        if($i==0){
          $this->data_cluster[$i] = $this->centroid;
          $this->centroid_allof[$i]=$this->data_cluster[$i];
        }else{
          $this->data_cluster[$i] = $this->data_cluster[$i-1];
          $this->centroid_allof[$i]=$this->data_cluster[$i];
        }
        //Cari Jarak
        foreach ($this->data as $c) {
          $distance_data = array();
          foreach ($this->data_cluster[$i] as $d) {
            $cluster_data = array();
            for ($x=0;$x<$this->dimensi;$x++) {
              $cluster_data[$x]=pow(abs($c[$x]-$d[$x]),2);
            }
            $distance_data[] = sqrt(array_sum($cluster_data));
          }
          $this->distance[$i][]=$distance_data;
        }
        //cluster
        $x=0;
        foreach ($this->distance[$i] as $key) {
          $min=min($key);
          $c = array_search($min,$key);
          $this->cluster[$i][$x] = $c;
          $x++;
        }
        //repoint
        $this->data_cluster[$i] =  array();
        foreach ($this->cluster[$i] as $key => $value) {
          $this->data_cluster[$i][$value][] = $this->data[$key];
        }
        $this->data_cluster_temp = $this->data_cluster[$i];
        $this->data_cluster[$i] = array();
        //---
        foreach ($this->data_cluster_temp as $key => $value) {
          $temp=array();
          foreach ($value as $keys => $values) {
            foreach ($values as $keyx => $valuem) {
              $temp[$keyx][]=$this->data_cluster_temp[$key][$keys][$keyx];
            }
          }
          for($x1=0;$x1<sizeof($temp);$x1++){
            $this->data_cluster[$i][$key][$x1]=array_sum($temp[$x1])/count($temp[$x1]);
          }
        }
        $temp2[$i] = array();
        $max_temp2 = array_keys($this->data_cluster[$i]);
        $max_temp2 = max($max_temp2);

        for($u=0;$u<=$max_temp2;$u++){
          if(isset($this->data_cluster[$i][$u])){
            $temp2[$i][$u] = $this->data_cluster[$i][$u];
          }
        }
        $this->data_cluster[$i]=$temp2[$i];
        if($i>0){
          if($this->stoploop($i)){break;}
        }
    }
  }
  private function stoploop($i){
    if(sizeof($this->cluster)>1){
      $last_index_cluster = sizeof($this->cluster)-1;
      for($x=0;$x<sizeof($this->cluster[$last_index_cluster]);$x++){
        if($this->cluster[$last_index_cluster][$x] != $this->cluster[($last_index_cluster-1)][$x]){
          return false;
        }else if($i>$this->maxloop-2){
          return true;
        }
      }
      return true;
    }else{return false;}
  }
  private function centroid_random(){
      $central = round(sizeof($this->data)/$this->jmlcentroid,0);
      $step = $central;
      $cek=0;$c=0;
      for($z=0;$z<sizeof($this->data);$z++){
        $temp=[];
        for($d=0;$d<$this->dimensi;$d++){
          $temp[]=$this->data[$z][$d];
        }
        if((($z % $central) < $central && $z % $central != 0) || $z==0){
            $temp_centroid_awal[$c][$z]=$temp;
        }else{
          if($c+1 < $this->jmlcentroid){
            $c++;
          }
            $temp_centroid_awal[$c][$z]=$temp;
        }
      }
      foreach ($temp_centroid_awal as $key => $value) {
        $temp=[];
        foreach ($value as $keys => $values) {
          for($d=0;$d<$this->dimensi;$d++){
            $temp[$d][]=$temp_centroid_awal[$key][$keys][$d];
          }
        }
        $temps[$key]=$temp;
      }
      foreach ($temp_centroid_awal as $key => $value) {
        $arr_rand = array();
        foreach ($value as $keys => $values) {
          array_push($arr_rand,$keys);
        }

        $inde = rand(min($arr_rand),max($arr_rand));
        $centroid_awal[$key] = $value[$inde];
      }
      return $centroid_awal;
  }
  private function centroid_rata_rata(){
      $central = round(sizeof($this->data)/$this->jmlcentroid,0);
      $step = $central;
      $this->dimensi = sizeof($this->data[0]);
      $cek=0;$c=0;
      for($z=0;$z<sizeof($this->data);$z++){
        $temp=[];
        for($d=0;$d<$this->dimensi;$d++){
          $temp[]=$this->data[$z][$d];
        }
        if((($z % $central) < $central && $z % $central != 0) || $z==0){
            $temp_centroid_awal[$c][$z]=$temp;
        }else{
          if($c+1 < $this->jmlcentroid){
            $c++;
          }
            $temp_centroid_awal[$c][$z]=$temp;
        }
      }
      foreach ($temp_centroid_awal as $key => $value) {
        $temp=[];
        foreach ($value as $keys => $values) {
          for($d=0;$d<$this->dimensi;$d++){
            $temp[$d][]=$temp_centroid_awal[$key][$keys][$d];
          }
        }
        $temps[$key]=$temp;
      }
      foreach ($temp_centroid_awal as $key => $value) {
        for($d=0;$d<$this->dimensi;$d++){
          $centroid_awal[$key][$d]=array_sum($temps[$key][$d])/count($temps[$key][$d]);
        }
      }
      return $centroid_awal;
  }
  private function centroid_custom(){
    $centroid = $this->session->userdata('c');
    $output = array();
    foreach ($centroid as $key) {
      $temp = array();
      foreach ($key as $keys) {
        array_push($temp,$keys);
      }
      array_push($output,$temp);
    }
    return $output;
  }
  private function centroid_fill(){
    $centroid = $this->session->userdata('isimanual');
    $output = json_decode($centroid, true);
    return $output;
  }
}
