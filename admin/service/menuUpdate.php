<?php
$_ENV = parse_ini_file('../../.env');
session_start();
include 'config.php';

// Ambil data dari form
$menu_id = $_POST['id'];
$name = $_POST['name'];
$name_english = $_POST['name_english'];
$jenis = $_POST['jenis'];
$harga = $_POST['harga'];
$keterangan = $_POST['keterangan'];
$keterangan_english = $_POST['keterangan_english'];
$status = $_POST['status'];
$file_name = $_FILES['gambar']['name'];

// Cek apakah ada file gambar yang baru diunggah
if (!empty($file_name)) {
    // Ambil nama file gambar lama dari database
    $sql = "SELECT gambar FROM menus WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $menu_id);
    $stmt->execute();
    $stmt->bind_result($gambar_lama);
    $stmt->fetch();
    $stmt->close();

    // Hapus file gambar lama jika ada
    if ($gambar_lama) {
        $file_path = "../gambar/menus/" . $gambar_lama;
        if (file_exists($file_path)) {
            unlink($file_path); // Menghapus file gambar lama
        }
    }

    // Proses upload gambar baru
    $target_dir = "../gambar/menus/";
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
        $sql = "UPDATE menus SET name = ?, name_english = ?, jenis = ?, harga = ?, keterangan = ?, keterangan_english = ?, status = ?, gambar = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssdssisi", $name, $name_english, $jenis, $harga, $keterangan, $keterangan_english, $status, $unique_file_name, $menu_id);
    } else {
        die("Terjadi kesalahan saat mengunggah gambar.");
    }
} else {
    // Update query tanpa mengubah gambar
    $sql = "UPDATE menus SET name = ?, name_english = ?, jenis = ?, harga = ?, keterangan = ?, keterangan_english = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdsssi", $name, $name_english, $jenis, $harga, $keterangan, $keterangan_english, $status, $menu_id);
}

// Eksekusi query
if ($stmt->execute()) {
    $_SESSION['alert'] = 'suksesdiupdate';
    header("Location: ../menu/edit-menu/index.php?id=$menu_id");
} else {
    echo "Terjadi kesalahan saat mengubah data: " . $stmt->error;
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
