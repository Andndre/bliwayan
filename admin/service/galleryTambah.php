<?php
$_ENV = parse_ini_file('../../.env');
session_start();
// Koneksi ke database
include 'config.php';

    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $jenis = $_POST['jenis'];
    $status = $_POST['status'];

    // Proses upload gambar
    $target_dir = "../gambar/gallerys/";

    // Cek apakah direktori ada, jika tidak, buat direktori
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $file_name = basename($_FILES["gambar"]["name"]);
    $file_tmp = $_FILES["gambar"]["tmp_name"];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Buat nama file yang unik dengan menambahkan timestamp
    $unique_file_name = uniqid() . '.' . $file_ext;
    $target_file = $target_dir . $unique_file_name;

    // Cek apakah file yang diunggah adalah gambar atau video
    $allowed_ext = array("jpg", "jpeg", "png", "gif", "mp4", "webm", "ogg");
    if (!in_array($file_ext, $allowed_ext)) {
        die("Hanya format JPG, JPEG, PNG, GIF, MP4, WebM, OGG yang diperbolehkan.");
    }

    // Cek ukuran file (misalnya maksimal 3MB)
    if ($_FILES["gambar"]["size"] > 3000000) {
        $_SESSION['alert'] = 'gagal';
        $conn->rollback();
        die("Ukuran file terlalu besar. Maksimal 2MB.");
        exit;
    }

    // Jika semua validasi lolos, simpan file
    if (move_uploaded_file($file_tmp, $target_file)) {
        // File berhasil diunggah, simpan informasi ke database
        $sql = "INSERT INTO gallerys (file, judul, deskripsi, jenis, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $unique_file_name, $judul, $deskripsi, $jenis, $status);
        // Eksekusi query
        if ($stmt->execute()) {
            $_SESSION['alert'] = 'success';
            header('location:../gallery');
        } else {
            $_SESSION['alert'] = 'gagal';
            header('location:../gallery/tambah-gallery');
        }

        $stmt->close();
    } else {
        echo "Terjadi kesalahan saat mengunggah gambar.";
    }

    // Tutup koneksi
    $conn->close();

?>

