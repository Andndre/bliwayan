<?php 
  include '../service/config.php'; 

  // Data user yang akan dimasukkan
  $name = "Admin";
  $email = "admin@gmail.com";
  $password = "12345678"; // Password asli

  // Hash password sebelum disimpan ke database
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Query untuk menyisipkan data user ke tabel 'users' (gunakan tanda tanya ? untuk parameter)
  $sql = "INSERT INTO users (name, email, password, foto) VALUES (?, ?, ?, ?)";

  // Persiapkan statement untuk menghindari SQL Injection
  $stmt = $conn->prepare($sql);
  
  // Foto kosong untuk sementara
  $foto = '';

  // Mengikat parameter (bind_param), pastikan urutan sesuai dengan query
  $stmt->bind_param("ssss", $name, $email, $hashedPassword, $foto);

  // Eksekusi query
  if ($stmt->execute()) {
      echo "Data user berhasil dimasukkan!";
  } else {
      echo "Terjadi kesalahan: " . $stmt->error;
  }

  // Menutup statement dan koneksi
  $stmt->close();
  $conn->close();
?>

