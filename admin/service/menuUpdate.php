<?php
include 'config.php';

// Ambil data dari form
$menu_id = $_POST['id'];
$name = $_POST['name'];
$jenis = $_POST['jenis'];
$harga = $_POST['harga'];
$keterangan = $_POST['keterangan'];
$status = $_POST['status'];
$file_name = $_FILES['gambar']['name'];

// Jika pengguna mengunggah gambar baru
if (!empty($file_name)) {
    // Proses upload gambar
    $target_dir = "../gambar/menus/";
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $unique_file_name = uniqid() . '.' . $file_ext;
    $target_file = $target_dir . $unique_file_name;

    // Cek apakah file yang diunggah adalah gambar
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check === false) {
        die("File bukan gambar.");
    }

    // Cek ukuran file (maksimal 2MB)
    if ($_FILES["gambar"]["size"] > 2000000) {
        die("Ukuran file terlalu besar (maksimal 2MB).");
    }

    // Hanya file gambar tertentu yang diperbolehkan
    $allowed_ext = array("jpg", "jpeg", "png", "gif");
    if (!in_array($file_ext, $allowed_ext)) {
        die("Hanya format JPG, JPEG, PNG, dan GIF yang diperbolehkan.");
    }

    // Simpan file gambar baru
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        // Update query dengan gambar baru
        $sql = "UPDATE menus SET name = ?, jenis = ?, harga = ?, keterangan = ?, status = ?, gambar = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdsisi", $name, $jenis, $harga, $keterangan, $status, $unique_file_name, $menu_id);
    } else {
        die("Terjadi kesalahan saat mengunggah gambar.");
    }
} else {
    // Update query tanpa mengubah gambar
    $sql = "UPDATE menus SET name = ?, jenis = ?, harga = ?, keterangan = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdssi", $name, $jenis, $harga, $keterangan, $status, $menu_id);
}

// Eksekusi query
if ($stmt->execute()) {
    header('Location: ../menu/');
} else {
    echo "Terjadi kesalahan saat mengubah data: " . $stmt->error;
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
