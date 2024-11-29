<?php
$_ENV = parse_ini_file('../../.env');
session_start();
if(!isset($_SESSION['user_id'])) {
    header('location:login/');
    exit;
}

include 'config.php';

// Ambil ID menu dari URL
$user_messages_id = $_GET['id'];

// Cek apakah ID menu ada
if(isset($user_messages_id)) {
    
    // Query untuk menghapus data menu dari database
    $sql = "DELETE FROM user_messages WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_messages_id);
    
    if($stmt->execute()) {
        $_SESSION['alert'] = 'suksesdihapus';
        header('location:../user-messages');
    } else {
        echo "Gagal menghapus menu!";
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
} else {
    echo "ID menu tidak ditemukan!";
}
?>
