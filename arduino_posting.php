<?php
// Connect to your database (you may need to modify the connection details)
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get current date and time
$tanggaljam = date('Y-m-d H:i:s');

if (!empty($_POST['suhu']) && !empty($_POST['kelembaban']) && !empty($_POST['pH'])) {
    $suhu = $_POST['suhu'];
    $kelembaban = $_POST['kelembaban'];
    $pH = $_POST['pH'];

    // Prepare and execute the SQL query
    $sql = "INSERT INTO sensor_data (tanggaljam, suhu, kelembaban, pH) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $tanggaljam, $suhu, $kelembaban, $pH);

    if ($stmt->execute()) {
        echo "OK";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
