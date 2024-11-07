<?php
  // baca .env
  $_ENV = parse_ini_file('../../.env');

  $servername = $_ENV['DB_HOST'];
  $username = $_ENV['DB_USERNAME'];
  $password = $_ENV['DB_PASSWORD'];
  $dbname = $_ENV['DB_NAME'];

  // Buat koneksi
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Cek koneksi
  if ($conn->connect_error) {
      die("Koneksi gagal: " . $conn->connect_error);
  }
?>
