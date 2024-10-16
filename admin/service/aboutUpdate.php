<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:login/');
    exit;
}

include 'config.php';

// Ambil data dari form
$id = $_POST['id'];
$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];
$whatsapp = $_POST['whatsapp'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$judul_video = $_POST['judul_video'];
$judul_kedua = $_POST['judul_kedua'];
$deskripsi_kedua = $_POST['deskripsi_kedua'];
$link_youtube = $_POST['link_youtube'];

// Ambil data lama dari database untuk mengecek gambar sebelumnya
$query = "SELECT gambar_pertama, gambar_kedua, video FROM deskripsi WHERE id = ?";
$stmt_old = $conn->prepare($query);
$stmt_old->bind_param("i", $id);
$stmt_old->execute();
$stmt_old->bind_result($old_gambar_pertama, $old_gambar_kedua, $old_video);
$stmt_old->fetch();
$stmt_old->close();

// Proses gambar pertama jika ada
if (!empty($_FILES['gambar_pertama']['name'])) {
    // Hapus gambar pertama sebelumnya
    if ($old_gambar_pertama && file_exists("../gambar/about/" . $old_gambar_pertama)) {
        unlink("../gambar/about/" . $old_gambar_pertama);
    }
    $gambar_pertama = $_FILES['gambar_pertama']['name'];
    $gambar_pertama_tmp = $_FILES['gambar_pertama']['tmp_name'];
    $gambar_pertama_path = "../gambar/about/" . basename($gambar_pertama);
    move_uploaded_file($gambar_pertama_tmp, $gambar_pertama_path);
} else {
    // Tidak mengganti gambar pertama
    $gambar_pertama = null;
}

// Proses gambar kedua jika ada
if (!empty($_FILES['gambar_kedua']['name'])) {
    // Hapus gambar kedua sebelumnya
    if ($old_gambar_kedua && file_exists("../gambar/about/" . $old_gambar_kedua)) {
        unlink("../gambar/about/" . $old_gambar_kedua);
    }
    $gambar_kedua = $_FILES['gambar_kedua']['name'];
    $gambar_kedua_tmp = $_FILES['gambar_kedua']['tmp_name'];
    $gambar_kedua_path = "../gambar/about/" . basename($gambar_kedua);
    move_uploaded_file($gambar_kedua_tmp, $gambar_kedua_path);
} else {
    // Tidak mengganti gambar kedua
    $gambar_kedua = null;
}

// Proses video jika ada
if (!empty($_FILES['video']['name'])) {
    // Hapus video sebelumnya
    if ($old_video && file_exists("../gambar/about/" . $old_video)) {
        unlink("../gambar/about/" . $old_video);
    }
    $video = $_FILES['video']['name'];
    $video_tmp = $_FILES['video']['tmp_name'];
    $video_path = "../gambar/about/" . basename($video);
    move_uploaded_file($video_tmp, $video_path);
} else {
    // Tidak mengganti video
    $video = null;
}

// Query untuk mengupdate data
$sql = "UPDATE deskripsi SET 
        judul = ?, 
        deskripsi = ?, 
        whatsapp = ?, 
        email = ?, 
        alamat = ?, 
        judul_video = ?, 
        judul_kedua = ?, 
        deskripsi_kedua = ?, 
        link_youtube = ?";

// Tambahkan update gambar dan video jika ada
if ($gambar_pertama) {
    $sql .= ", gambar_pertama = ?";
}
if ($gambar_kedua) {
    $sql .= ", gambar_kedua = ?";
}
if ($video) {
    $sql .= ", video = ?";
}

$sql .= " WHERE id = ?";

// Siapkan statement
$stmt = $conn->prepare($sql);

// Bind parameter berdasarkan apakah ada file baru yang diupload atau tidak
if ($gambar_pertama && $gambar_kedua && $video) {
    $stmt->bind_param("ssssssssssssi", $judul, $deskripsi, $whatsapp, $email, $alamat, $judul_video, $judul_kedua, $deskripsi_kedua, $link_youtube, $gambar_pertama, $gambar_kedua, $video, $id);
} elseif ($gambar_pertama && $gambar_kedua) {
    $stmt->bind_param("sssssssssssi", $judul, $deskripsi, $whatsapp, $email, $alamat, $judul_video, $judul_kedua, $deskripsi_kedua, $link_youtube, $gambar_pertama, $gambar_kedua, $id);
} elseif ($gambar_pertama && $video) {
    $stmt->bind_param("sssssssssssi", $judul, $deskripsi, $whatsapp, $email, $alamat, $judul_video, $judul_kedua, $deskripsi_kedua, $link_youtube, $gambar_pertama, $video, $id);
} elseif ($gambar_kedua && $video) {
    $stmt->bind_param("sssssssssssi", $judul, $deskripsi, $whatsapp, $email, $alamat, $judul_video, $judul_kedua, $deskripsi_kedua, $link_youtube, $gambar_kedua, $video, $id);
} elseif ($gambar_pertama) {
    $stmt->bind_param("ssssssssssi", $judul, $deskripsi, $whatsapp, $email, $alamat, $judul_video, $judul_kedua, $deskripsi_kedua, $link_youtube, $gambar_pertama, $id);
} elseif ($gambar_kedua) {
    $stmt->bind_param("ssssssssssi", $judul, $deskripsi, $whatsapp, $email, $alamat, $judul_video, $judul_kedua, $deskripsi_kedua, $link_youtube, $gambar_kedua, $id);
} elseif ($video) {
    $stmt->bind_param("ssssssssssi", $judul, $deskripsi, $whatsapp, $email, $alamat, $judul_video, $judul_kedua, $deskripsi_kedua, $link_youtube, $video, $id);
} else {
    $stmt->bind_param("sssssssssi", $judul, $deskripsi, $whatsapp, $email, $alamat, $judul_video, $judul_kedua, $deskripsi_kedua, $link_youtube, $id);
}

// Eksekusi statement
if ($stmt->execute()) {
  $_SESSION['update_success'] = true;
    header('Location: ../about-settings');
} else {
    echo "Error: " . $stmt->error;
}

// Tutup statement
$stmt->close();
$conn->close();
?>
