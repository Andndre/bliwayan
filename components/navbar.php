<?php
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


<?php
session_start(); // Start the session

function text($en, $id) {
  $lang = $_SESSION['lang'] ?? 'en';
  return $lang === 'en' ? $en : $id;
}

// Set default language to English
$lang = 'en';

// Check if language parameter is passed via GET request
if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'id'])) {
    $lang = $_GET['lang'];
    $_SESSION['lang'] = $lang;  // Save the language in session
}

// Check if language is already saved in session and no language parameter is passed
if (!isset($_GET['lang']) && isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
}

?>
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="/images/logo.png" alt="" height="60">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link <?= $_SERVER['REQUEST_URI'] === '/' ? 'active' : '' ?>" href="/"><?= text('Home', 'Beranda') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'about') !== false ? 'active' : '' ?>" href="/about"><?= text('About', 'Tentang Kami') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'menu') !== false ? 'active' : '' ?>" href="/menu"><?= text('Menu', 'Menu') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'gallery') !== false ? 'active' : '' ?>" href="/gallery"><?= text('Gallery', 'Galeri') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'contact') !== false ? 'active' : '' ?>" href="/contact"><?= text('Contact', 'Kontak') ?></a>
        </li>
      </ul>
      <div class="navbar-nav ml-auto">
        <div class="nav-item">
          <a class="btn btn-outline-secondary" href="/book-now/"><?= text('Book a Table', 'Pesan Meja') ?></a>
        </div>
        <!-- Language Dropdown -->
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= text('Language', 'Bahasa') ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
            <li><a class="dropdown-item" href="/?lang=en">English</a></li>
            <li><a class="dropdown-item" href="/?lang=id">Indonesian</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>

