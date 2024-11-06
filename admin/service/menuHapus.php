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
    $sql = "SELECT gambar FROM menus WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $menu_id);
    $stmt->execute();
    $stmt->bind_result($gambar);
    $stmt->fetch();
    $stmt->close();

    // Hapus file gambar dari folder jika file gambar ada
    if($gambar) {
        $file_path = "../gambar/menus/" . $gambar;
        if(file_exists($file_path)) {
            unlink($file_path); // Menghapus file gambar
        }
    }

    // Query untuk menghapus data menu dari database
    $sql = "DELETE FROM menus WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $menu_id);
    
    if($stmt->execute()) {
        $_SESSION['alert'] = 'suksesdihapus';
        header('location:../menu');
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
