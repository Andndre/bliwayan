<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header('location:login/');
    exit;
}

include 'config.php';

// Ambil ID menu dari URL
$menu_id = $_GET['id'];

// Cek apakah ID menu ada
if(isset($menu_id)) {
    // Query untuk menghapus data menu
    $sql = "DELETE FROM menus WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $menu_id);
    
    if($stmt->execute()) {
        // Redirect setelah sukses menghapus
        header('location:../menu/index.php?message=Menu berhasil dihapus');
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
