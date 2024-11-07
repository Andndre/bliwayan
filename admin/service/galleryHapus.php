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
    // Ambil nama file gambar dari database sebelum menghapus data
    $sql = "SELECT file FROM gallerys WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $menu_id);
    $stmt->execute();
    $stmt->bind_result($gambar);
    $stmt->fetch();
    $stmt->close();

    // Hapus file gambar dari folder jika file gambar ada
    if($gambar) {
        $file_path = "../gambar/gallerys/" . $gambar;
        if(file_exists($file_path)) {
            unlink($file_path); // Menghapus file gambar
        }
    }

    // Query untuk menghapus data menu dari database
    $sql = "DELETE FROM gallerys WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $menu_id);
    
    if($stmt->execute()) {
        $_SESSION['alert'] = 'suksesdihapus';
        header('location:../gallery');
    } else {
        echo "Gagal menghapus!";
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
} else {
    echo "ID menu tidak ditemukan!";
}
?>
