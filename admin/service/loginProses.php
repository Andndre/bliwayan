<?php
session_start();
include 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi input (pastikan tidak kosong)
    if (empty($email) || empty($password)) {
        die('Email dan password wajib diisi.');
    }

    // Cek apakah email ada di database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Ambil data user
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Password benar, buat session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            // Redirect ke halaman dashboard
            header('Location: ../');
            exit();
        } else {
            echo 'Password salah!';
        }
    } else {
        echo 'Email tidak ditemukan!';
    }
}
?>
