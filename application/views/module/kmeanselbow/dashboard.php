<body>
    
<div class="col-xl-12">
    <div class="card-box">
    <div class="table-container" style="height: 400px; overflow: auto;">
        <div class="table-responsive">
            <!--Tabel Sensor Data-->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal Jam</th>
                        <th>Suhu</th>
                        <th>pH</th>
                        <th>Kelembaban</th>
                        <th>Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Ambil Model dan function untuk ambil data sensor dari database
                $CI = &get_instance();
                $CI->load->model('KmeansElbow_Model'); 
                $log_entries = $CI->KmeansElbow_Model->getSensorData(); // Ambil data dari file model

                if (!empty($log_entries)):
                    foreach ($log_entries as $entry):
                    ?><!-- Menampilkan data dari database ke tabel dibawah-->
                        <tr> 
                            <td><?php echo $entry->id; ?></td>
                            <td><?php echo $entry->tanggaljam; ?></td>
                            <td><?php echo $entry->suhu; ?></td>
                            <td><?php echo $entry->pH; ?></td>
                            <td><?php echo $entry->kelembaban; ?></td>
                            <td><?php echo $entry->kondisi;?></td>
                        </tr>
                    <?php
                    endforeach;
                else:
                    ?> <!-- Jika tidak ada data / Tabel kosong -->
                    <tr>
                        <td colspan="5">No data available.</td>
                    </tr>
                <?php
                endif;
                ?>
                </tbody>
            </table>
        </div>   
</div>
<div class="export-button-container" style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
        <!-- Tombol hapus data -->
        <button id="delete-data-button" class="delete-button" style="padding: 10px 20px; background-color: #FF0000; color: #fff; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;">
            Delete Sensor Data
        </button>
        <!-- Tombol Thingspeak -->
        <a href="https://thingspeak.com" target="_blank" class="export-button" style="padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;">
            Go To ThingSpeak
        </a>
        <!-- Tombol Export Data -->
        <form method="post" action="<?= base_url('exportdata') ?>">
            <input type="hidden" name="export_data" value="1">
            <button type="submit" class="export-button" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;">
                Export Data
            </button>
        </form>
    </div>
    
    <!-- JavaScript untuk konfirmasi hapus data -->
    <script>
    document.getElementById("delete-data-button").addEventListener("click", function() {
        var confirmDelete = confirm("Are you sure you want to delete all sensor data?");
        if (confirmDelete) {
            // Mengirim AJAX untuk menghapus semua data pada tabel Sensor Data
            $.ajax({
                type: "POST",
                url: "", // Arahkan ke controller
                data: { delete_all: true },
                success: function(response) {
                    if (response === "success") {
                        alert("All data deleted successfully!");
                        // Refresh halaman setelah data dihapus
                        location.reload();
                    } else {
                        alert("All data deleted successfully!");
                    }
                },
                error: function() {
                    alert("An error occurred while processing the request.");
                }
            });
        }
        });
    </script>

    <?php
    // Ambil Model
    $CI = &get_instance();
    $CI->load->model('KmeansElbow_Model');

    // Cek jika metode request sudah jadi POST dan apakah parameter delete_all sudah diset
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_all'])) {
        // Call the deleteAllSensorData method from the model
        if ($CI->KmeansElbow_Model->deleteAllSensorData()) {
            echo "success";
        } else {
            echo "error";
        }
        exit(); // Hentikan script
    }
    ?>

</body>




