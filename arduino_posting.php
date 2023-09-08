<?php
// Set zona waktu
date_default_timezone_set('Asia/Jakarta');

// Properti koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kopi";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// set format tanggal waktu
$current_time = date('Y-m-d H:i:s');

if (!empty($_POST['suhu']) && !empty($_POST['kelembaban']) && !empty($_POST['pH'])) {
    $suhu = $_POST['suhu'];
    $kelembaban = $_POST['kelembaban'];
    $pH = $_POST['pH'];

    // Menyiapkan query
    $sql = "INSERT INTO sensor_data (tanggaljam, suhu, kelembaban, pH) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Use appropriate placeholders: "s" for string, "d" for double, "i" for integer
    $stmt->bind_param("ssdd", $current_time, $suhu, $kelembaban, $pH);

    if ($stmt->execute()) {
        echo "OK";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>