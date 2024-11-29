<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="id">

<?php include_once 'layout/head.php'; ?>
<body>
<?php 
$_ENV = parse_ini_file('.env');
?>
<?php include 'components/navbar.php'; ?>
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
?>
<main>
	<!-- Hero - Start -->
	<section style="background-image: url('images/bg-hero.png'); height: 100dvh; background-repeat: no-repeat; background-size: cover; background-position: center;">
		<div class="container h-100">
			<div class="d-flex flex-column gap-2 h-100 justify-content-center align-items-center text-center">
				<h1 style="max-width: 600px;"><?= text("Best food for your taste", "Makanan terbaik untuk Anda") ?></h1>
				<p style="max-width: 500px;"><?= text("Come for the food, and experience with our friendly service.", "Datanglah untuk mencicipi makanannya, dan rasakan pengalaman dengan layanan kami yang ramah.") ?></p>
				<div class="d-flex gap-2 justify-content-center">
					<a href="/book-now" class="btn btn-primary">
						<?= text("Book a Table", 'Pesan Meja') ?>
					</a>
					<a href="/menu" class="btn btn-outline-secondary">
						<?= text("Explore Our Menu", 'Lihat Menu Kami') ?>
					</a>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero - End -->
	<!-- Browse Our Menu - Start -->
	<section class="container py-5">
		<div class="pt-5"></div>
		<h2 class="text-center"><?= text("Browse Our Menu", "Jelajahi Menu Kami") ?></h2>
		<div class="row pt-4">
			<div class="col-12 col-md-6 col-lg-3 mt-3">
				<div class="card">
					<div class="card-body text-center">
						<img src="/images/icons/breakfast.svg" alt="breakfast icon" class="w-50" style="max-width: 100px;">
						<h3 class="pt-4"><?= text("Breakfast", "Sarapan") ?></h3>
						<p><small><?= text("Start your day with our delicious breakfast options, designed to energize and inspire your morning.", "Mulailah hari Anda dengan pilihan sarapan lezat kami, dirancang untuk memberi energi dan menginspirasi pagi Anda.") ?></small></p>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3 mt-3">
				<div class="card">
					<div class="card-body text-center">
						<img src="/images/icons/main-dishes.svg" alt="main dishes icon" class="w-50" style="max-width: 100px;">
						<h3 class="pt-4"><?= text("Main Dishes", "Hidangan Utama") ?></h3>
						<p><small><?= text("Enjoy our main dishes, crafted with fresh ingredients and authentic flavors to satisfy your appetite.", "Nikmati hidangan utama kami, dibuat dengan bahan segar dan rasa otentik untuk memuaskan selera Anda.") ?></small></p>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3 mt-3">
				<div class="card">
					<div class="card-body text-center">
						<img src="/images/icons/drinks.svg" alt="drinks icon" class="w-50" style="max-width: 100px;">
						<h3 class="pt-4"><?= text("Drinks", "Minuman") ?></h3>
						<p><small><?= text("Refresh yourself with our wide range of beverages, from refreshing cool drinks to warm and soothing options.", "Segarkan diri Anda dengan berbagai minuman kami, dari minuman dingin yang menyegarkan hingga pilihan yang hangat dan menenangkan.") ?></small></p>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3 mt-3">
				<div class="card">
					<div class="card-body text-center">
						<img src="/images/icons/desserts.svg" alt="desserts icon" class="w-50" style="max-width: 100px;">
						<h3 class="pt-4"><?= text("Desserts", "Pencuci Mulut") ?></h3>
						<p><small><?= text("End your meal on a sweet note with our delightful selection of desserts to indulge your taste buds.", "Akhiri makanan Anda dengan catatan manis dengan pilihan pencuci mulut kami yang menyenangkan untuk memanjakan selera Anda.") ?></small></p>
					</div>
				</div>
			</div>
		</div>
		<div class="pt-4 text-center">
			<a class="btn btn-outline-secondary" href="/book-now/"><?= text("Book a Table", "Pesan Meja") ?></a>
		</div>
	</section>
	<!-- Browse Our Menu - End -->

	<!-- Kami menyajikan makanan sehat untuk keluarga Anda - Start -->
	 <section class="bg-light">
			<div class="container py-5">
				<div class="pt-5"></div>
				<div class="row">	
					<div class="col-12 col-lg-6" style="position: relative;">
						<img class="img-fluid" style="width: 80%;" src="/admin/gambar/about/<?=$data['gambar_pertama']?>" alt="illustration">
						<div class="card card-dark" style="position: absolute; bottom: 0; right: 1rem;">
							<div class="card-body w-100" style="max-width: 300px;">
								<h3><?= text("Come and visit us", "Datang dan kunjungi kami") ?></h3>
								<ul class="list-unstyled">
									<li class="d-flex gap-2 align-items-start"><i data-feather="phone-call" class="icon-size"></i> <?= $data["whatsapp"] ?></li>
									<li class="d-flex gap-2 align-items-start"><i data-feather="mail" class="icon-size"></i> <a href="mailto:<?= $data["email"] ?>" style="text-decoration: none; color: white;"><?= $data["email"] ?></a></li>
									<li class="d-flex gap-2 align-items-start"><i data-feather="map-pin" class="icon-size"></i> <?= $data["alamat"] ?></li>
                </ul>
							</div>
						</div>
					</div>
					<div class="col-12 col-lg-6">
						<h2><?= text("We provide healthy food for your family", "Kami menyajikan makanan sehat untuk keluarga Anda") ?>.</h2>
						<p class="pt-3"><?= text("The story of Bli Wayan Cafe & Kitchen begins with a vision to become a comfortable place to eat, able to satisfy customers, making the taste of the food memorable and hard to forget. Rooted in a rich culinary culture, we strive to honor our local culinary riches while incorporating global flavors.", "Kami memiliki visi untuk menjadi tempat yang nyaman untuk makan, mampu memuaskan pelanggan, membuat rasa makanan yang tidak terlupakan. Berakar dalam budaya kuliner yang kaya, kami berusaha untuk menghormati kekayaan kuliner lokal kami sambil mengintegrasikan rasa global.") ?></p>
						<p class="pt-3"><?= text("At Bli Wayan Cafe & Kitchen, we believe that dining is not just about the food, but also about the entire experience. Our staff, known for their friendliness and dedication, strives to make every visit a memorable moment.", "Di Bli Wayan Cafe & Kitchen, kami percaya bahwa makan tidak hanya tentang makanan, tapi juga tentang pengalaman keseluruhan. Staf kami, yang dikenal karena kesabaran dan dedikasi, berusaha keras untuk membuat setiap kunjungan menjadi momen yang tak terlupakan.") ?></p>
						<a href="/about" class="btn btn-outline-secondary mt-3"><?= text("More About Us", "Tentang Kami") ?></a>
					</div>
				</div>
			</div>
	 </section>
	<!-- Kami menyajikan makanan sehat untuk keluarga Anda - End -->

	<!-- Kami juga menawarkan layanan optimal untuk pengalaman Anda - Mulai -->
	<section class="container py-5">
		<div class="pt-5"></div>
		<h2><?= text("We also offer optimal services for your experience", "Kami juga menawarkan layanan optimal untuk pengalaman Anda") ?>.</h2>
		<div class="row pt-5">
			<div class="col-12 col-md-6 col-lg-3">
				<img class="img-fluid" src="/images/illustrations/vip.png" alt="vip">
				<h3 class="pt-4"><?= text("VIP", "VIP") ?></h3>
				<p><?= text("Enjoy exclusive and special service for those seeking a dining experience beyond the ordinary.", "Nikmati layanan eksklusif dan khusus untuk mereka yang mencari pengalaman makan yang luar biasa.") ?></p>
			</div>
			<div class="col-12 col-md-6 col-lg-3">
				<img class="img-fluid" src="/images/illustrations/bd.png" alt="birthday">
				<h3 class="pt-4"><?= text("Birthdays", "Hari Ulang Tahun") ?></h3>
				<p><?= text("Celebrate your special day with unforgettable moments, accompanied by delicious food and a warm atmosphere.", "Rayakan hari spesial Anda dengan momen yang tak terlupakan, ditemani dengan makanan yang lezat dan suasana yang hangat.") ?></p>
			</div>
			<div class="col-12 col-md-6 col-lg-3">
				<img class="img-fluid" src="/images/illustrations/ft.png" alt="family time">
				<h3 class="pt-4"><?= text("Family Time", "Waktu Keluarga") ?></h3>
				<p><?= text("Gather your family and spend quality time together while enjoying favorite dishes for everyone.", "Kumpulkan keluarga Anda dan habiskan waktu berkualitas bersama sambil menikmati hidangan favorit untuk semua.") ?></p>
			</div>
			<div class="col-12 col-md-6 col-lg-3">
				<img class="img-fluid" src="/images/illustrations/ho.png" alt="hang out">
				<h3 class="pt-4"><?= text("Hang Out", "Hang Out") ?></h3>
				<p><?= text("The perfect place to relax and hang out with friends, with a cozy atmosphere and mouth-watering food.", "Tempat yang sempurna untuk bersantai dan hang out dengan teman, dengan suasana yang nyaman dan makanan yang lezat.") ?></p>
			</div>
		</div>
	</section>
	<!-- Kami juga menawarkan layanan optimal untuk pengalaman Anda - Selesai -->
	
	<!-- Fasilitas Tempat Nyaman untuk Segala Aktivitas - Start -->
	<section class="bg-light">
			<div class="container py-5">
				<div class="pt-5"></div>
				<div class="row align-items-center">	
					<div class="col-12 col-lg-6">
						<img class="img-fluid" src="/images/illustrations/illustration-2.png" alt="illustration">
					</div>
					<div class="col-12 col-lg-6">
						<h2><?= text("comfortable place facilities for all activities", "Fasilitas Tempat Nyaman untuk Segala Aktivitas") ?>.</h2>
						<p class="pt-3"><?= text("Bli Wayan Cafe and Kitchen has an outdoor area that pampers the natural views and a comfortable indoor area with tables and chairs as well as a relaxing area for sitting on bean bag pillows. Each of our places is suitable as an aesthetic and instagrammable photo spot..", "Bli Wayan Cafe and Kitchen memiliki area luar yang memanjakan pemandangan alam dan area indoor yang nyaman dengan meja dan kursi serta area bersantai untuk duduk di bantal bean bag. Setiap tempat kami cocok sebagai spot foto yang unik dan instagrammable.") ?></p>
						<ul class="list-style-none list-icons-primary pt-3">
							<li><i data-feather="clock"></i> <?= text("Delivery within 30 minutes", "Pengiriman dalam waktu 30 menit") ?></li>
							<li><i data-feather="percent"></i> <?= text("Best Offer & Prices", "Penawaran Terbaik & Harga") ?></li>
							<li><i data-feather="shopping-cart"></i> <?= text("Online Services Available", "Layanan Online Tersedia") ?></li>
						</ul>
					</div>
				</div>
			</div>
	 </section>
	<!-- Fasilitas Tempat Nyaman untuk Segala Aktivitas - End -->

	<!-- what our customer say - Start -->
	<section class="container py-5">
		<div class="pt-5"></div>
		<h2 class="text-center"><?= text("What Our Customers Say.", "Apa yang Pelanggan Kami Katakan.") ?></h2>
		<div class="row pt-5">
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card">
					<div class="card-body">
						<img class="img-fluid" src="/images/reviews/1.png" alt="">
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card">
					<div class="card-body">
						<img class="img-fluid" src="/images/reviews/2.png" alt="">
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<div class="card">
					<div class="card-body">
						<img class="img-fluid" src="/images/reviews/3.png" alt="">
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- what our customer say - End -->
</main>
<?php include 'components/footer.php'; ?>
<?php include 'layout/scripts.php'; ?>
</body>
</html>
