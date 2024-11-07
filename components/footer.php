<?php
    $id = 1;

    // Ambil data menu berdasarkan ID dari database
    $sql = "SELECT * FROM deskripsi WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika menu ditemukan
    if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
    } else {
            echo "Menu tidak ditemukan!";
            exit;
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();
?>

<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="img-fluid" style="max-width: 200px;" src="/images/logo-bw.png" alt="bliwayan logo">
                <p>Come for the food, and experience with our friendly service.</p>
                <ul class="social-links list-unstyled d-flex gap-3">
                    <li><a href="#" style="text-decoration: none; color: white;"><i data-feather="instagram" class="icon-size"></i></a></li>
                    <li><a href="#" style="text-decoration: none; color: white;"><i data-feather="facebook" class="icon-size"></i></a></li>
                    <li><a href="#" style="text-decoration: none; color: white;"><i data-feather="twitter" class="icon-size"></i></a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4><?= text('Navigation', 'Navigasi') ?></h4>
                <nav>
                    <ul class="list-unstyled">
                        <li><a href="/" style="text-decoration: none; color: white;">Home</a></li>
                        <li><a href="/about" style="text-decoration: none; color: white;">About</a></li>
                        <li><a href="/menu" style="text-decoration: none; color: white;">Menu</a></li>
                        <li><a href="/gallery" style="text-decoration: none; color: white;">Gallery</a></li>
                        <li><a href="/book-now" style="text-decoration: none; color: white;">Reservasi</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-4">
                <h4><?= text('Contact Us', 'Hubungi Kami') ?></h4>
                <ul class="list-unstyled">
                    <li class="d-flex gap-2 align-items-start"><i data-feather="map-pin" class="icon-size"></i> <?= $data["alamat"] ?></li>
                    <li class="d-flex gap-2 align-items-start"><i data-feather="phone-call" class="icon-size"></i> <?= $data["whatsapp"] ?></li>
                    <li class="d-flex gap-2 align-items-start"><i data-feather="mail" class="icon-size"></i> <a href="mailto:<?= $data["email"] ?>" style="text-decoration: none; color: white;"><?= $data["email"] ?></a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p class="text-center mt-5 text-gray">Copyright © 2024 Bli Wayan Cafe & Kitchen</p>
            </div>
        </div>
    </div>
</footer>
