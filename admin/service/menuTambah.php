<?php
$_ENV = parse_ini_file('../../.env');
session_start();
// Koneksi ke database
include 'config.php';

    $name = $_POST['name'];
    $name_english = $_POST['name_english'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];
    $keterangan = $_POST['keterangan'];
    $keterangan_english = $_POST['keterangan_english'];
    $status = $_POST['status'];

    // Proses upload gambar
    $target_dir = "../gambar/menus/";

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

    // Cek apakah file yang diunggah adalah gambar
    $check = getimagesize($file_tmp);
    if ($check === false) {
        die("File bukan gambar.");
    }

    // Cek ukuran file (misalnya maksimal 2MB)
    if ($_FILES["gambar"]["size"] > 2000000) {
        $_SESSION['alert'] = 'gagal';
        $conn->rollback();
        header('location:../menu/tambah-menu');
        exit;
    }

    // Batasi jenis file yang diperbolehkan (misalnya hanya jpg, png, jpeg, gif)
    $allowed_ext = array("jpg", "jpeg", "png", "gif");
    if (!in_array($file_ext, $allowed_ext)) {
        die("Hanya format JPG, JPEG, PNG, dan GIF yang diperbolehkan.");
    }

    // Jika semua validasi lolos, simpan file
    if (move_uploaded_file($file_tmp, $target_file)) {
        // File berhasil diunggah, simpan informasi ke database
        $sql = "INSERT INTO menus (gambar, name, name_english, jenis, harga, keterangan, keterangan_english, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssisss", $unique_file_name, $name, $name_english, $jenis, $harga, $keterangan, $keterangan_english, $status);
        // Eksekusi query
        if ($stmt->execute()) {
            $_SESSION['alert'] = 'success';
            header('location:../menu');
        } else {
            $_SESSION['alert'] = 'gagal';
            header('location:../menu/tambah-menu');
        }

        $stmt->close();
    } else {
        echo "Terjadi kesalahan saat mengunggah gambar.";
    }

    // Tutup koneksi
    $conn->close();

?>
