<?php
$_ENV = parse_ini_file('../../.env');
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:login/');
    exit;
}

include 'config.php';

// Ambil data dari form
$instagram = $_POST['instagram'];
$facebook = $_POST['facebook'];
$youtube = $_POST['youtube'];
$id = 1;

// Query untuk mengupdate data
$sql = "UPDATE media_social 
        SET instagram = ?, facebook = ?, youtube = ? 
        WHERE id = ?";
$stmt = $conn->prepare($sql);

// Bind parameter
$stmt->bind_param("sssi", $instagram, $facebook, $youtube, $id);

// Eksekusi statement
if ($stmt->execute()) {
    $_SESSION['alert'] = 'berhasil';
    header('location:../about-settings');
} else {
    echo "Error: " . $stmt->error;
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>
