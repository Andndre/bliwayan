<!DOCTYPE html>
<html lang="id">
<?php include '../layout/head.php'; ?>


<body>
    <?php
    $_ENV = parse_ini_file('../.env');
    ?>
    <?php include '../components/navbar.php'; ?>
    <?php
    $id = 1;
    
    // Ambil data menu berdasarkan ID dari database
    $sql = 'SELECT * FROM deskripsi WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Jika menu ditemukan
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        echo 'Menu tidak ditemukan!';
        exit();
    }
    
    // Tutup koneksi
    $stmt->close();
    
    // Get media_social
    
    $sql = 'SELECT * FROM media_social WHERE id = ?';
    
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param('i', $id);
    
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $data_media = $result->fetch_assoc();
    } else {
        echo 'Media sosial tidak ditemukan!';
        exit();
    }
    
    // $conn->close();
    
    ?>

    <header class="pt-5">
        <div class="py-5 container">
            <div class="text-center pt-5">
                <h1><?= text('Contact Us', 'Hubungi Kami') ?></h1>
                <p style="max-width: 730px; margin: 0 auto">
                    <?= text("Hi, thank you for your interest in Bli Wayan Cafe & Kitchen! 😊 We are always ready to welcome you with delicious dishes and a cozy atmosphere. If you have any questions, would like to make a reservation, or just want to share some feedback, don't hesitate to reach out to us through the contact details below.", 'Hai, terima kasih telah tertarik dengan Bli Wayan Cafe & Kitchen! 😊 Kami selalu siap menyambut Anda dengan hidangan lezat dan suasana nyaman. Jika Anda memiliki pertanyaan, ingin melakukan reservasi, atau sekadar memberikan saran, jangan ragu untuk menghubungi kami melalui kontak di bawah ini.') ?>
                </p>
            </div>
            <div class="pt-5 row" style="max-width: 730px; margin: 0 auto">
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-center gap-2" style="margin-bottom: 1rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="#1EFF00" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M21 11.5a8.37 8.37 0 0 1-.9 3.8 8.49 8.49 0 0 1-7.6 4.7 8.37 8.37 0 0 1-3.8-.9L3 21l1.9-5.7a8.37 8.37 0 0 1-.9-3.8 8.49 8.49 0 0 1 4.7-7.6 8.37 8.37 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8Z" />
                            <path
                                d="M9.49 10a7.58 7.58 0 0 0 .72 1.42A8 8 0 0 0 14 14.5M9.49 10a7.47 7.47 0 0 1-.4-1.4.51.51 0 0 1 .52-.6h0a.54.54 0 0 1 .51.37l.38 1.13ZM14 14.5a7.8 7.8 0 0 0 1.43.41.51.51 0 0 0 .6-.52h0a.54.54 0 0 0-.37-.51l-1.16-.38Z" />
                        </svg>
                        <div class="">
                            <p class="mb-0 " style="font-size: 16px;">BOOK YOUR TABLE</p>
                            <a href="https://wa.me/62<?= preg_replace('/^0/', '', str_replace('-', '', $data['whatsapp'])) ?>"
                                style="text-decoration: none; color: black;">
                                <?= $data['whatsapp'] ?>
                            </a>
                        </div>
                    </div>
                    <p class="d-flex align-items-center gap-2">
                        <!-- instagram -->
                        <i data-feather="instagram" class="icon-size" style="color: #1EFF00;"></i>
                        <a href="<?= $data_media['instagram'] ?>" style="text-decoration: none; color: black;">
                            <?= explode('/', $data_media['instagram'])[3] ?>
                        </a>
                    </p>
                    <p class="d-flex align-items-center gap-2">
                        <!-- youtube -->
                        <i data-feather="youtube" class="icon-size" style="color: #1EFF00;"></i>
                        <a href="<?= $data_media['youtube'] ?>" style="text-decoration: none; color: black;">
                            <?= explode('/', $data_media['youtube'])[3] ?>
                        </a>
                    </p>
                </div>
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-center gap-2" style="margin-bottom: 1rem;">
                        <!-- waktu buka -->
                        <i data-feather="clock" class="icon-size" style="color: #1EFF00;"></i>
                        <div>
                            <?php foreach (explode("\n", $data['waktu_buka']) as $line): ?>
                            <p class="mb-0"><?= $line ?></p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <p class="d-flex align-items-center gap-2">
                        <!-- alamat -->
                        <i data-feather="map-pin" class="icon-size" style="color: #1EFF00;"></i>
                        <a href="https://maps.app.goo.gl/wbKoxV8onhHTP13U9" target="_blank"
                            style="text-decoration: none; color: black;">
                            <?= $data['alamat'] ?>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        </div>
    </header>
    <main>
        <section class="container pb-5">
            <div class="row">
                <div class="col-12 col-md-6 pt-5">
                    <iframe class="w-100 card" style="height: 400px;"
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15792.478352330496!2d115.1693822!3d-8.290896!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd189b8870c6149%3A0x5df0c93ff0d86b75!2sBli%20Wayan%20Cafe%20%26%20Kitchen!5e0!3m2!1sid!2sid!4v1732947779214!5m2!1sid!2sid"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-12 col-md-6 pt-5">
                    <div class="card shadow">
                        <div class="card-body">
                            <form id="contactForm" action="/admin/service/sendUserMessage.php" method="POST">
                                <div class="d-flex flex-wrap mb-3">
                                    <div class="me-3 flex-grow-1">
                                        <label for="name" class="form-label"><?= text('Name', 'Nama') ?></label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="flex-grow-1">
                                        <label for="email" class="form-label"><?= text('Email', 'Email') ?></label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                </div>
                                <!-- subject -->
                                <div class="mb-3">
                                    <label for="subject" class="form-label"><?= text('Subject', 'Subyek') ?></label>
                                    <input type="text" class="form-control" id="subject" name="subject">
                                </div>
                                <!-- message in textarea -->
                                <div class="mb-3">
                                    <label for="message" class="form-label"><?= text('Message', 'Pesan') ?></label>
                                    <textarea class="form-control" id="message" rows="3" name="message"></textarea>
                                </div>
                                <!-- submit button primary -->
                                <button type="submit"
                                    class="btn btn-primary w-100"><?= text('Send', 'Kirim') ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container py-5 d-flex flex-column gap-3">
                <?php
                $youtube = $data['link_youtube'];
                // get the id from the url
                $last = explode('/', $youtube)[3];
                $id = explode('?', $last)[0];
                ?>
                <iframe class="img-fluid" style="aspect-ratio: 16/9;" src="https://www.youtube.com/embed/<?= $id ?>"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </section>
    </main>
    <?php include '../components/footer.php'; ?>
    <?php include '../layout/scripts.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // check alert in session

        <?php if (isset($_SESSION['alert'])): ?>
        <?php if ($_SESSION['alert'] == 'success'): ?>
        Swal.fire({
            title: '<?= text('Message Sent', 'Pesan Terkirim') ?>',
            text: '<?= text('Thank you for contacting us. We will reply to your message as soon as possible.', 'Terima kasih telah menghubungi kami. Kami akan membalas pesan Anda secepat mungkin.') ?>',
            icon: 'success',
            allowOutsideClick: false,
            showConfirmButton: false,
            timer: 3000,
        });
        <?php else: ?>
        Swal.fire({
            title: '<?= text('Failed to Send Message', 'Gagal Mengirim Pesan') ?>',
            text: '<?= text('Sorry, we are unable to send your message. Please try again later.', 'Maaf, kami tidak dapat mengirim pesan Anda. Silakan coba lagi nanti.') ?>',
            icon: 'error',
            allowOutsideClick: false,
            showConfirmButton: false,
            timer: 3000,
        });
        <?php endif; ?>
        <?php unset($_SESSION['alert']); ?>
        <?php endif; ?>
    </script>
</body>

</html>
