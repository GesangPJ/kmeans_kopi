<?php
function aasort (&$array, $key) {
    $sorter = array();
    $ret = array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii] = $va[$key];
    }
    asort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii] = $array[$ii];
    }
    $array = $ret;
}
$process = array();
if($page == "cluster"){
  if(isset($_POST['simpan'])){
    //fungsi setiap menyimpan jumlah centroid, maksimal looping, dan nilai centroid ke dalam session
    $this->session->set_userdata('maxloop',$this->input->post('maxloop'));
    $this->session->set_userdata('centroid',$this->input->post('centroid'));
    $this->session->set_userdata('jmlcentroid',$this->input->post('jmlcentroid'));
    $this->session->set_userdata('c',$this->input->post('c'));
    $this->session->set_userdata('isimanual',$this->input->post('isimanual'));
  }
}
if($page == "execute"){
  //cluster execution, check if
  if($this->session->userdata('datatoprocess')!==NULL && $this->session->userdata('jmlcentroid')!==NULL && $this->session->userdata('centroid')!==NULL){
    //menginisialisasi data dulu pake fungsi init dan masukan kedalam parameter, fungsi2 nya ada di KmeansElbow_Model.php di folder application/model/
    $this->kmeanselbow->init($this->session->userdata('datatoprocess'),$this->session->userdata('jmlcentroid'),$this->session->userdata('centroid'),$this->session->userdata('maxloop'));
    $this->kmeanselbow->execute();
    //Get result from processed K-Means
    $process = $this->kmeanselbow->getprocess();
    //Result below
  }
}
?>
<script type="text/javascript" src="<?=base_url()?>assets/js/plot.js"></script>
<div class="row">
    <!-- Right Sidebar -->
    <div class="col-12">
        <div class="card-box">
            <!-- Left sidebar -->
            <div class="inbox-leftbar">
               <!-- <a href="email-compose.html" class="btn btn-danger btn-block waves-effect waves-light">K-Means & Elbow Menu</a>-->
                <div class="mail-list mt-4">
                  <!-- List menu -->
                    <a href="<?=base_url()?>KmeansElbow/process/dataset" class="list-group-item border-0 <?=$page=='dataset'?'font-weight-bold':'';?>">Dataset</a>
                    <a href="<?=base_url()?>KmeansElbow/process/elbow" class="list-group-item border-0 <?=$page=='elbow'?'font-weight-bold':'';?>">Optimasi Elbow</a>
                    <a href="<?=base_url()?>KmeansElbow/process/cluster" class="list-group-item border-0 <?=$page=='cluster'?'font-weight-bold':'';?>">Menentukan Centroid</a>
                    <a href="<?=base_url()?>KmeansElbow/process/execute" class="list-group-item border-0 <?=$page=='execute'?'font-weight-bold':'';?>">K-Means</a>
                    <a href="<?=base_url()?>KmeansElbow/process/result" class="list-group-item border-0 <?=$page=='result'?'font-weight-bold':'';?>">Hasil Clustering</a>
                </div>
            </div>
            <!-- End Left sidebar -->
            <div class="inbox-rightbar">
              <?php
                //jika memilih menu dataset kmeans
                if($page == 'dataset'){
                ?>
                <div class="col-md-12">
                    <div class="card-box">
                      <h3>UPLOAD DATASET</h3>
                      <!--
                      <small><a href="<?=base_url();?>assets/kmeanselbow/k-means-dataset.xlsx" target="_blank">Download contoh Format .xlsx</a></small>
                -->
                      <br>
                      <form enctype="multipart/form-data">
                          <input id="upload" type="file" name="files">
                          <button type="button" class="btn btn-primary btn-sm" id="upl" onclick="doupl()" style="display:none;">Upload</button>
                      </form>
                    </div>
                    <?php
                        //Ketika upload file data excel akan dikirim ke controller application/controller/operation.php untuk dilakukan pengambilan data dan dimasukan kedalam excel
                        if($this->session->userdata('process_dataset')!==NULL && $this->session->userdata('process_datasetindex')!==NULL){
                          //ambil data session dari data yang di upload, dan dimasukan kedalam variabel biasa untuk dilakukan pengolahan
                            $index = $this->session->userdata('process_datasetindex');
                            $dataset = $this->session->userdata('process_dataset');
                    ?>
                    <div class="card-box table-responsive">
                      <h4>Dataset K-Means & Elbow</h4>
                      <table class="table table-striped">
                        <thead>
                          <tr>
                          <?php
// ini fungsi untuk menampilkan data dari session kedalam bentuk tabel
foreach ($index as $key) {
    ?>
    <th><?= $key ?></th>
    <?php
}
?>
</tr>
</thead>
<tbody>
    <?php
    $datatoprocess = array();
    $indexdata = array();
    
    // Move the header row printing code outside of the dataset loop
    $firstIteration = true; // Initialize a flag to indicate the first iteration
    
    foreach ($dataset as $key) {
        ?>
        <tr>
            <?php
            $temp = array();
            $x = 0;
            foreach ($index as $keys) {
                if ($keys === "tanggaljam") { // Check if the column is "tanggaljam"
                    $datetimeIndex = date('Y-m-d H:i:s', strtotime($key[$keys])); // Convert to datetime format
                } else {
                    $datetimeIndex = $key[$keys]; // Assume other columns are already in datetime format
                }
                if (isset($datetimeIndex)) {
                    if ($x > 0) {
                        array_push($temp, $datetimeIndex);
                    } else {
                        array_push($indexdata, $datetimeIndex);
                    }
                    ?>
                    <td><?= $datetimeIndex ?></td>
                    <?php
                    $x++;
                }
            }
            ?>
        </tr>
        <?php
        array_push($datatoprocess, $temp);
        
        // Set the flag to false after the first iteration
        if ($firstIteration) {
            $firstIteration = false;
        }
    }
    $this->session->set_userdata("datatoprocess", $datatoprocess);
    $this->session->set_userdata("indexdata", $indexdata);
    ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="card-box table-responsive">
                      <h4>Dataset Normalisasi K-Means & Elbow</h4>
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <?php
                                // ini fungsi untuk menampilkan data dari session kedalam bentuk tabel
                                foreach ($index as $key) {
                                  ?>
                                   <th><?=$key?></th>
                                  <?php
                                }
                            ?>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                            $datatoprocess = array();
                            $indexdata = array();
                            foreach ($dataset as $key) {
                                ?>
                                <tr>
                                    <?php
                                    $temp = array();
                                    $x = 0;
                                     foreach ($index as $keys) {
                                       if($x>0){
                                         // array_push($temp,abs($key[$keys] - min(array_column($dataset,$keys)))/abs(min(array_column($dataset,$keys))-max(array_column($dataset,$keys))));
                                         ?>
                                             <td><?php echo abs($key[$keys] - min(array_column($dataset,$keys)))/abs(min(array_column($dataset,$keys))-max(array_column($dataset,$keys)));?></td>
                                         <?php
                                       }else{
                                         // array_push($indexdata,$key[$keys]);
                                         ?>
                                             <td><?php echo $key[$keys];?></td>
                                         <?php
                                       }
                                        $x++;
                                     }
                                    ?>
                                </tr>
                                <?php
                              // array_push($datatoprocess,$temp);
                            }
                            // $this->session->set_userdata("process_dataset",$dataset);
                            // $this->session->set_userdata("datatoprocess",$datatoprocess);
                            // $this->session->set_userdata("indexdata",$indexdata);
                            ?>
                        </tbody>
                      </table>
                    </div>
                    <?php } ?>
                  </div>
                <?php
                //Ketika memilih menu Tentukan Cluster
              }else if($page == 'cluster'){ ?>
                  <h4>Tentukan Centroid & Cluster</h4>
                  <br />
                  <?=form_open("kmeanselbow/process/cluster",array("class"=>"form-horizontal","role"=>"form"))?>
                  <form class="form-horizontal" role="form" method="POST">
                    <div id="clustermodal" class="modal fade">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Custom Cluster</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body p-4">
                                  <?php
                                      if($this->session->userdata('process_dataset')!==NULL && $this->session->userdata('process_datasetindex')!==NULL){
                                          $index = $this->session->userdata('process_datasetindex');
                                          $dataset = $this->session->userdata('process_dataset');
                                          ?>
                                          <div class="card-box table-responsive">
                                            <h4>Pilih Cluster</h4>
                                            <?php
                                            if($this->session->userdata('jmlcentroid')>0){
                                              //Menampilkan dataset dari session ke tabel
                                              ?>
                                              <table class="table table-striped">
                                                <thead>
                                                  <tr>
                                                    <?php
                                                        foreach ($index as $key) {
                                                          ?>
                                                           <th><?=$key?></th>
                                                          <?php
                                                        }
                                                    ?>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $n=0;
                                                    foreach ($dataset as $key) {
                                                        ?>
                                                        <tr>
                                                            <?php
                                                            $x=0;
                                                             foreach ($index as $keys) {
                                                               if($x>=1){
                                                                 ?>
                                                                     <td><?=$key[$keys]?>&nbsp;<input type="checkbox" name="c[<?=$keys?>][<?=$n?>]" value="<?=$key[$keys]?>" <?=isset($this->session->userdata('c')[$keys][$n])?'checked':''?>/></td>
                                                                 <?php
                                                               }else{
                                                                 ?>
                                                                     <td><?=$key[$keys]?></td>
                                                                 <?php
                                                               }
                                                                $x++;
                                                             }
                                                            ?>
                                                        </tr>
                                                        <?php
                                                        $n++;
                                                    }
                                                    ?>
                                                </tbody>
                                              </table>
                                              <?php
                                            }else{
                                              ?>
                                                <strong class="text-danger">*Jumlah Centroid Belum di Isi</strong>
                                              <?php
                                            }
                                            ?>
                                          </div>
                                          <?php
                                      }
                                  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="simpleinput">Type Centroid</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="centroid" onchange="typecentroid(event)">
                              <option value="rata-rata" <?=$this->session->userdata('centroid')=='rata-rata'?'selected':'';?>>Rata-Rata Nilai</option>
                              <option value="random" <?=$this->session->userdata('centroid')=='random'?'selected':'';?>>Random Centroid</option>
                              <option value="custom" <?=$this->session->userdata('centroid')=='custom'?'selected':'';?>>Custom Centroid (beta)</option>
                              <option value="fill" <?=$this->session->userdata('centroid')=='fill'?'selected':'';?>>Isi Manual</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="example-email">Jumlah Cluster</label>
                        <div class="col-sm-10">
                            <input type="number" id="jmlcls" name="jmlcentroid" min="2" <?=$this->session->userdata('process_dataset')===NULL?'readonly':''?> max="<?=$this->session->userdata('process_dataset')!==NULL?sizeof($this->session->userdata('process_dataset')):2?>" required value="<?=$this->session->userdata('jmlcentroid')?>" class="form-control" placeholder="<?=$this->session->userdata('process_dataset')===NULL?'Masukan Dataset Dahulu':'Jumlah Cluster'?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="example-email">Max Perulangan</label>
                        <div class="col-sm-10">
                            <input type="number" name="maxloop" value="<?=$this->session->userdata('maxloop')!==NULL?$this->session->userdata('maxloop'):10?>" class="form-control" placeholder="Maksimal Perulangan" required>
                        </div>
                    </div>
                    <div class="form-group row" id="fm" style="display:<?=$this->session->userdata('centroid')=='fill'?'flex':'none'?>;">
                        <label class="col-sm-2 col-form-label" for="example-email">Isi Manual</label>
                        <div class="col-sm-10">
                            <input type="text" name="isimanual" value="<?=$this->session->userdata("isimanual")!==NULL?$this->session->userdata("isimanual"):''?>" class="form-control" placeholder="Ex : [[1,5],[7,6],[2,9]]" />
                        </div>
                    </div>
                    <div class="form-group float-right">
                      <?php
                        if($this->session->userdata('process_dataset')!==NULL){
                          ?>
                            <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
                          <?php
                        }
                      ?>
                    </div>
                </form>
                <?php }else if($page == 'execute'){ ?>
                  <?php
                  if(sizeof($process)>0){
                    if($this->session->userdata('centroid') != NULL){
                      $loopresult = sizeof($process['cluster']);
                      $indexdata = $this->session->userdata('indexdata');
                      for($n=0;$n<$loopresult;$n++) {
                      ?>
                      <button class="btn btn-purple btn-block"><strong>Perulangan Ke - <?=$n+1?></strong></button>
                      <br />
                      <h4>Perulangan <?=$n+1?> - Penentuan Centroid</h4>
                      <div class="table-responsive">
                        <table class="table table-border">
                          <?php
                          $x=0;
                          foreach ($process['centroid'][$n] as $key) {
                            $x++;
                            ?>
                            <tr>
                              <td>Centroid <?=$x?></td>
                              <?php
                              foreach ($key as $keys) {
                                ?>
                                <td align="center"><?=$keys?></td>
                                <?php
                              }
                              ?>
                            </tr>
                            <?php
                          }
                          ?>
                        </table>
                      </div>
                      <hr />
                      <h4>Perulangan <?=$n+1?> - Hitung Euclidean Distance</h4>
                      <div class="table-responsive">
                        <table class="table table-border">
                          <?php
                          $x=0;
                          foreach ($process['distance'][$n] as $key) {
                            $x++;
                            ?>
                            <tr>
                              <td><?=$indexdata[$x-1]?></td>
                              <?php
                              foreach ($key as $keys) {
                                ?>
                                <td align="center"><?=$keys?></td>
                                <?php
                              }
                              ?>
                            </tr>
                            <?php
                          }
                          ?>
                        </table>
                      </div>
                      <hr />
                      <h4>Perulangan <?=$n+1?> - Hasil Cluster</h4>
                      <div class="table-responsive">
                        <table class="table table-border">
                          <?php
                          $x=0;
                          $kmeans_result=array();
                          foreach ($process['cluster'][$n] as $key) {
                            $x++;
                            ?>
                            <tr>
                              <td><?=$indexdata[$x-1]?></td>
                              <td><?=($key+1)?></td>
                            </tr>
                            <?php
                            $kmeans_result[]=array($indexdata[$x-1],($key+1));
                          }
                          $this->session->set_userdata("kmeans_result",$kmeans_result);
                          ?>
                        </table>
                      </div>
                    <?php } ?>
                      <?php
                    }
                  }
                  ?>
              <?php }else if($page == 'elbow'){ ?>
                  <h4><i>ELBOW METHOD</i></h4>
                  <br />
                  <p>Mencari titik <i>centroid</i> yang optimal dengan menggunakan perhitungan <i>cluster</i> <?=$this->session->userdata('centroid')?> dari <i>dataset</i></p>
                  <form class="form-horizontal" role="form" method="POST">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="simpleinput">Jumlah Cluster</label>
                        <div class="col-sm-3">
                            <input type="number" name="maxel" class="form-control" min="2" max="<?=$this->session->userdata('process_dataset')!==NULL?sizeof($this->session->userdata('process_dataset')):5?>" placeholder="Maksimal Cluster">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="example-email">Max. Perulangan</label>
                        <div class="col-sm-6">
                            <input type="number" name="maxloopel" value="" class="form-control" placeholder="max loop elbow">
                        </div>
                    </div>
                    <div class="form-group float-left">
                      <button class="btn btn-primary" type="submit" name="elbowsimpan">Mulai Proses</button>
                    </div>
                </form>
                <br /><br /><br />
                <div class="card">
                    <div class="card-header bg-warning py-2 text-white">
                        <div class="card-widgets">
                            <a href="#" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                            <a data-toggle="collapse" href="#cardCollpase6" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class="mdi mdi-minus"></i></a>
                            <a href="#" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                        </div>
                        <h5 class="card-title mb-0 text-white">Hasil Metode Elbow</h5>
                    </div>
                    <div id="cardCollpase6" class="collapse show">
                        <script>var dataelbow=[];</script>
                        <div class="card-body table-responsive">
                            <?php
                              if(isset($_POST['elbowsimpan']) && isset($_POST['maxel']) && isset($_POST['maxloopel'])){
                                if($this->session->userdata('datatoprocess')!==NULL){
                                  // Untuk mengoptimalkan jumlah cluster, menggunakan fungsi elbow_optimize ada di file KmeansElbow_Model
                                  $elbow = $this->kmeanselbow->elbow_optimize($this->session->userdata('datatoprocess'),$this->input->post('maxel'),$this->input->post('maxloopel'),$this->session->userdata('centroid'));
                                  // echo "<pre>";print_r($elbow['process']);echo "</pre>";
                                  ?>
                                    <h4>Process Elbow</h4>
                                    <table class="table table-border">
                                      <thead>
                                        <th>Cluster</th>
                                        <?php
                                          $x=0;
                                          foreach ($this->session->userdata("process_datasetindex") as $key) {
                                            if($x>0){
                                              ?>
                                                <th><?=$key?></th>
                                              <?php
                                            }
                                            $x++;
                                          }
                                        ?>
                                        <th>Hasil Penjumlahan</th>
                                      </thead>
                                      <tbody>
                                      <?php
                                      foreach ($elbow['process'] as $key) {
                                        foreach ($key as $keys) {
                                          ?>
                                            <tr>
                                              <?php
                                              foreach ($keys as $keyn) {
                                                ?>
                                                  <td><?=$keyn?></td>
                                                <?php
                                              }
                                              ?>
                                            </tr>
                                          <?php
                                        }

                                      }
                                      ?>
                                    </tbody>
                                    </table>
                                    <h4>Hasil Algoritma Elbow</h4>
                                    <table class="table table-border">
                                      <thead>
                                        <th>Cluster</th>
                                        <th>Nilai</th>
                                        <th>Selisih</th>
                                      </thead>
                                      <tbody>
                                      <?php
                                      $elbows = [];
                                      foreach ($elbow['hasil'] as $key) {
                                        $elbows[$key['cluster']] = $key['selisih'];
                                        ?>
                                          <tr>
                                            <td><?=$key['cluster']?></td>
                                            <td><?=$key['nilai']?></td>
                                            <td><?=$key['selisih']?></td>
                                          </tr>
                                          <script>dataelbow.push([<?=$key['cluster']?>,<?=$key['selisih']?>]);</script>
                                        <?php
                                      }
                                      asort($elbows);
                                      foreach ($elbows as $key => $value) {
                                        $this->session->set_userdata("elbows",$key);
                                        break;
                                      }
                                      ?>
                                    </tbody>
                                    </table>
                                  <?php
                                }else{
                                  echo "<h4>Silahkan Upload Dataset</h4>";
                                }
                              }
                            ?>

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="header-title">Elbow Graph</h4>
                                    <p style="margin-bottom:-50px;">SSE</p>
                                    <div id="website-stats1" style="height: 350px;" class="flot-chart mt-5"></div>
                                    <p style="text-align:center;">Jumlah Cluster</p>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
              <?php }else if($page == "result"){
                $obj = "";
                ?>
                <h4>Hasil Cluster KMeans</h4>
                <div class="table-responsive" id="export">
                  <table class="table table-border">
                    <thead>
                      <?php
                        foreach ($this->session->userdata("process_datasetindex") as $n => $v) {
                          if($n==0){
                            $obj = $v;
                          }
                          ?>
                          <th><?=$v?></th>
                          <?php
                        }
                      ?>
                      <th>Cluster</th>
                    </thead>
                    <?php
                    if($this->session->userdata("kmeans_result")!==NULL){
                      $resk = $this->session->userdata("kmeans_result");
                      aasort($resk,1);
                      foreach ($resk as $key) {
                        ?>
                        <tr>
                          <td><?=$key[0]?></td>
                          <?php
                           foreach ($this->session->userdata("process_datasetindex") as $n => $v) {
                             if($n>0){
                               $attr = array_column($this->session->userdata("process_dataset"),$v,$obj);
                               ?>
                               <td><?=$attr[$key[0]]?></td>
                               <?php
                             }

                           }
                          ?>
                          <td><?=$key[1]?></td>
                        </tr>
                        <?php
                      }
                    }
                    ?>
                  </table>
                  <h4>Jumlah Cluster</h4>
                  <table class="table table-border">
                    <thead>
                      <th>Cluster</th>
                      <th>Jumlah</th>
                    </thead>
                    <?php
                    if($this->session->userdata("kmeans_result")!==NULL){
                      $res = array();
                      foreach ($this->session->userdata("kmeans_result") as $key) {
                        if(!isset($res[$key[1]])){
                          $res[$key[1]]=1;
                        }else{
                          $res[$key[1]]++;
                        }
                      }
                      foreach ($res as $key => $val) {
                        ?>
                        <tr>
                          <td><?=$key?></td>
                          <td><?=$val?></td>
                      </tr>
                        <?php
                      }
                    }
                    ?>
                  </table>
                </div>
                <button class="btn btn-purple" onclick="Export2Word('export','export.docx')">Export</button>
                <?php
              } ?>
            </div>
            <div class="clearfix"></div>
        </div> <!-- end card-box -->
    </div> <!-- end Col -->
</div>
<script>
$(document).ready(function () {
  //Grafik untuk menampilkan hasil elbow optimize
  if(typeof dataelbow !== 'undefined'){
      var dataset = [
          {
              label: "line1",
              data: dataelbow
          }
      ];
      var options = {
        axisLabels: {
                show: true
            },
        xaxes: [{
                axisLabel: 'foo',
            }],
        yaxes: [{
                position: 'left',
                axisLabel: 'bar',
            }, {
                position: 'right',
                axisLabel: 'bleem'
            }],
        series: {
              lines: { show: true },
              points: {
                  radius: 3,
                  show: true
              }
          }
      }
      $.plot($("#website-stats1"), dataset, options);
  }
});
function Export2Word(element, filename = ''){
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
    var postHtml = "</body></html>";
    var html = preHtml+document.getElementById(element).innerHTML+postHtml;

    var blob = new Blob(['\ufeff', html], {
        type: 'application/msword'
    });

    // Specify link url
    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);

    // Specify file name
    filename = filename?filename+'.doc':'document.doc';

    // Create download link element
    var downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if(navigator.msSaveOrOpenBlob ){
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = url;

        // Setting the file name
        downloadLink.download = filename;

        //triggering the function
        downloadLink.click();
    }

    document.body.removeChild(downloadLink);
}
function typecentroid(e){
  var type = $(e.target).val();
  if(type=='custom'){
    $('#clustermodal').modal('show');
  }else if(type=='fill'){
    $('#fm').show();
  }else {
    $('#fm').hide();
  }
}
</script>
