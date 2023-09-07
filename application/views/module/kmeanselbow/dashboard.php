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
                            <td><?php echo $entry->kelembaban; ?></td>
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
        <!-- Add the "Delete Sensor Data" button on the left -->
        <button id="delete-data-button" class="delete-button" style="padding: 10px 20px; background-color: #FF0000; color: #fff; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;">
            Delete Sensor Data
        </button>
        <!-- Centered "Go To ThingSpeak" button -->
        <a href="https://thingspeak.com" target="_blank" class="export-button" style="padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;">
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
    
    <!-- JavaScript for handling delete confirmation -->
    <script>
    document.getElementById("delete-data-button").addEventListener("click", function() {
        var confirmDelete = confirm("Are you sure you want to delete all sensor data?");
        if (confirmDelete) {
            // Send an AJAX request to delete all data in the 'sensor_data' table
            $.ajax({
                type: "POST",
                url: "", // Leave this empty since you're not using a separate controller
                data: { delete_all: true },
                success: function(response) {
                    if (response === "success") {
                        alert("All data deleted successfully!");
                        // Optionally, refresh the page or update the table
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
    // Load the model
    $CI = &get_instance();
    $CI->load->model('KmeansElbow_Model');

    // Check if the request method is POST and if 'delete_all' parameter is set
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_all'])) {
        // Call the deleteAllSensorData method from the model
        if ($CI->KmeansElbow_Model->deleteAllSensorData()) {
            echo "success";
        } else {
            echo "error";
        }
        exit(); // Prevent further execution of the script
    }
    ?>

</body>




