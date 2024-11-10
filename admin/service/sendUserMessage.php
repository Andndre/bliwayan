<?php
$_ENV = parse_ini_file('../../.env');
session_start();
// Koneksi ke database
include 'config.php';

$name = $_POST['name'];
$subject = $_POST['subject'];
$email = $_POST['email'];
$message = $_POST['message'];

// Simpan ke database
$sql = "INSERT INTO user_messages (name, subject, email, message) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $subject, $email, $message);
if ($stmt->execute()) {
    $_SESSION['alert'] = 'success';
    header('location:/contact');
} else {
    $_SESSION['alert'] = 'gagal';
    header('location:/contact');
}

$stmt->close();
?>
