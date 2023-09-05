<body>
<div class="col-xl-12">
    <div class="card-box">
    <div class="table-container" style="height: 400px; overflow: auto;">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal Jam</th>
                        <th>Suhu</th>
                        <th>pH</th>
                        <th>Kelembaban</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $CI = &get_instance();
                $CI->load->model('KmeansElbow_Model'); // Load the model
                $log_entries = $CI->KmeansElbow_Model->getSensorData(); // Retrieve data from the model

                if (!empty($log_entries)):
                    foreach ($log_entries as $entry):
                    ?>
                        <tr>
                            <td><?php echo $entry->id; ?></td>
                            <td><?php echo $entry->tanggaljam; ?></td>
                            <td><?php echo $entry->suhu; ?></td>
                            <td><?php echo $entry->pH; ?></td>
                            <td><?php echo $entry->kelembapan; ?></td>
                        </tr>
                    <?php
                    endforeach;
                else:
                    ?>
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
        <!-- Add the "Go To ThingSpeak" button on the left with a target="_blank" attribute -->
        <a href="https://thingspeak.com/channels/public" target="_blank" class="export-button" style="padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;">
            Go To ThingSpeak
        </a>
        <!-- Move the "Export Data" button to the right -->
        <form method="post" action="../kmeanselbow/export.php">
            <input type="hidden" name="export_data" value="1">
            <button type="submit" class="export-button" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;">
                Export Data
            </button>
        </form>
    </div>

</body>




