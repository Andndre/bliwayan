<?php
session_start();
include 'config.php';

// Ambil data dari form
$id = $_POST['id'];
$judul = $_POST['judul'];
$jenis = $_POST['jenis'];
$deskripsi= $_POST['deskripsi'];
$status = $_POST['status'];
$file_name = $_FILES['gambar']['name'];

// Cek apakah ada file gambar yang baru diunggah
if (!empty($file_name)) {
    // Ambil nama file gambar lama dari database
    $sql = "SELECT file FROM gallerys WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($gambar_lama);
    $stmt->fetch();
    $stmt->close();

    // Hapus file gambar lama jika ada
    if ($gambar_lama) {
        $file_path = "../gambar/gallerys/" . $gambar_lama;
        if (file_exists($file_path)) {
            unlink($file_path); // Menghapus file gambar lama
        }
    }

    // Proses upload gambar baru
    $target_dir = "../gambar/gallerys/";
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $unique_file_name = uniqid() . '.' . $file_ext;
    $target_file = $target_dir . $unique_file_name;

    // Validasi file gambar baru
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check === false) {
        die("File bukan gambar.");
    }

    // Cek ukuran file (maksimal 2MB)
    if ($_FILES["gambar"]["size"] > 2000000) {
        die("Ukuran file terlalu besar (maksimal 2MB).");
    }

    // Batasi jenis file yang diperbolehkan
    $allowed_ext = array("jpg", "jpeg", "png", "gif");
    if (!in_array($file_ext, $allowed_ext)) {
        die("Hanya format JPG, JPEG, PNG, dan GIF yang diperbolehkan.");
    }

    // Simpan file gambar baru
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        // Update query dengan gambar baru
        $sql = "UPDATE gallerys SET judul = ?, jenis = ?, deskripsi = ?, status = ?, file = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $judul, $jenis, $deskripsi, $status, $unique_file_name, $id);
    } else {
        die("Terjadi kesalahan saat mengunggah gambar.");
    }
} else {
    // Update query tanpa mengubah gambar
    $sql = "UPDATE gallerys SET judul = ?, jenis = ?, deskripsi = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $judul, $jenis, $deskripsi, $status, $id);
}

// Eksekusi query
if ($stmt->execute()) {
    $_SESSION['alert'] = 'suksesdiupdate';
    header("Location: ../gallery/edit-gallery/index.php?id=$id");
} else {
    echo "Terjadi kesalahan saat mengubah data: " . $stmt->error;
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
