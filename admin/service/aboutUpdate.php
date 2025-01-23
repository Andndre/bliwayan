<?php
$_ENV = parse_ini_file('../../.env');
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
$company_profile = $_POST['company_profile'];
$link_youtube = $_POST['link_youtube'];
$judul_english = $_POST['judul_english'];
$deskripsi_english = $_POST['deskripsi_english'];
$judul_video_english = $_POST['judul_video_english'];
$judul_kedua_english = $_POST['judul_kedua_english'];
$deskripsi_kedua_english = $_POST['deskripsi_kedua_english'];
$brand_book = $_POST['brand_book'];
$waktu_buka = $_POST['waktu_buka'];

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
    if ($old_gambar_pertama && file_exists("../gambar/about/" . $old_gambar_pertama)) {
        unlink("../gambar/about/" . $old_gambar_pertama);
    }
    $gambar_pertama = $_FILES['gambar_pertama']['name'];
    $gambar_pertama_tmp = $_FILES['gambar_pertama']['tmp_name'];
    $gambar_pertama_path = "../gambar/about/" . basename($gambar_pertama);
    move_uploaded_file($gambar_pertama_tmp, $gambar_pertama_path);
} else {
    $gambar_pertama = null;
}

// Proses gambar kedua jika ada
if (!empty($_FILES['gambar_kedua']['name'])) {
    if ($old_gambar_kedua && file_exists("../gambar/about/" . $old_gambar_kedua)) {
        unlink("../gambar/about/" . $old_gambar_kedua);
    }
    $gambar_kedua = $_FILES['gambar_kedua']['name'];
    $gambar_kedua_tmp = $_FILES['gambar_kedua']['tmp_name'];
    $gambar_kedua_path = "../gambar/about/" . basename($gambar_kedua);
    move_uploaded_file($gambar_kedua_tmp, $gambar_kedua_path);
} else {
    $gambar_kedua = null;
}

// // Proses video jika ada
// if (!empty($_FILES['video']['name'])) {
//     if ($old_video && file_exists("../gambar/about/" . $old_video)) {
//         unlink("../gambar/about/" . $old_video);
//     }
//     $video = $_FILES['video']['name'];
//     $video_tmp = $_FILES['video']['tmp_name'];
//     $video_path = "../gambar/about/" . basename($video);
//     move_uploaded_file($video_tmp, $video_path);
// } else {
//     $video = null;
// }

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
        company_profile = ?,
        link_youtube = ?, 
        judul_english = ?, 
        deskripsi_english = ?, 
        judul_video_english = ?, 
        judul_kedua_english = ?, 
        deskripsi_kedua_english = ?, 
        brand_book = ?,
        waktu_buka = ?";

// Tambahkan update gambar dan video jika ada
$types = "sssssssssssssssss";
$params = [$judul, $deskripsi, $whatsapp, $email, $alamat, $judul_video, $judul_kedua, $deskripsi_kedua, $company_profile, $link_youtube, $judul_english,  $deskripsi_english, $judul_video_english,  $judul_kedua_english, $deskripsi_kedua_english, $brand_book, $waktu_buka];

if ($gambar_pertama) {
    $sql .= ", gambar_pertama = ?";
    $types .= "s";
    $params[] = $gambar_pertama;
}
if ($gambar_kedua) {
    $sql .= ", gambar_kedua = ?";
    $types .= "s";
    $params[] = $gambar_kedua;
}
// if ($video) {
//     $sql .= ", video = ?";
//     $types .= "s";
//     $params[] = $video;
// }

$sql .= " WHERE id = ?";
$types .= "i";
$params[] = $id;

// Siapkan statement
$stmt = $conn->prepare($sql);

// Bind parameter menggunakan referensi
$stmt->bind_param($types, ...$params);

// Eksekusi statement
if ($stmt->execute()) {
    $_SESSION['alert'] = 'sukses';
    header('location:../about-settings');
} else {
    echo "Error: " . $stmt->error;
}

// Tutup statement
$stmt->close();
$conn->close();
?>
