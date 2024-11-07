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

// Array for translations
$translations = [
    'en' => [
        'home' => 'Home',
        'about' => 'About',
        'menu' => 'Menu',
        'gallery' => 'Gallery',
        'contact' => 'Contact',
        'language' => 'Language',
        'book_table' => 'Book a Table',
        'explore_menu' => 'Explore Menu',
        'hero_heading' => 'Best food for your taste',
        'hero_subheading' => 'Come for the food, and experience with our friendly service',
      ],
      'id' => [
        'home' => 'Beranda',
        'about' => 'Tentang Kami',
        'menu' => 'Menu',
        'gallery' => 'Galeri',
        'contact' => 'Kontak',
        'language' => 'Bahasa',
        'book_table' => 'Pesan Meja',
        'explore_menu' => 'Lihat Menu',
        'hero_heading' => 'Makanan terbaik sesuai selera Anda',
        'hero_subheading' => 'Datanglah untuk mencicipi makanannya, dan rasakan pengalaman dengan layanan kami yang ramah',
    ]
];

/**
 * Function to get translated text based on language and key
 * @param string $lang Language code (e.g., 'en' or 'id')
 * @param string $key Key for the translation (e.g., 'home', 'about')
 * @return string
 */
function translate($lang, $key) {
    global $translations;
    if (isset($translations[$lang][$key])) {
        return $translations[$lang][$key];
    } else {
        return $key;  // Fallback to key if translation is not available
    }
}

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
          <a class="nav-link <?= $_SERVER['REQUEST_URI'] === '/' ? 'active' : '' ?>" href="/"><?= translate($lang, 'home') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'about') !== false ? 'active' : '' ?>" href="/about"><?= translate($lang, 'about') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'menu') !== false ? 'active' : '' ?>" href="/menu"><?= translate($lang, 'menu') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'gallery') !== false ? 'active' : '' ?>" href="/gallery"><?= translate($lang, 'gallery') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= strpos($_SERVER['REQUEST_URI'], 'contact') !== false ? 'active' : '' ?>" href="/contact"><?= translate($lang, 'contact') ?></a>
        </li>
      </ul>
      <div class="navbar-nav ml-auto">
        <div class="nav-item">
          <a class="btn btn-outline-secondary" href="/book-now/"><?= translate($lang, 'book_table') ?></a>
        </div>
        <!-- Language Dropdown -->
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= translate($lang, 'language') ?>
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
