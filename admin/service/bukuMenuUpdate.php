<?php
$_ENV = parse_ini_file('../../.env');
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:login/');
    exit;
}

include 'config.php';

// Ambil data dari form
$link = $_POST['link'];
$id = 1;

// Query untuk mengupdate data
$sql = "UPDATE buku_menu SET link = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

// Bind parameter
$stmt->bind_param("si", $link, $id);

// Eksekusi statement
if ($stmt->execute()) {
    $_SESSION['alert'] = 'sukses';
    header('location:../menu');
} else {
    echo "Error: " . $stmt->error;
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>
