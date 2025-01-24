<!DOCTYPE html>
<html lang="id">
<?php include '../layout/head.php'; ?>
<body>
<?php 
$_ENV = parse_ini_file('../.env');
?>
<?php include '../components/navbar.php'; ?>
<main>
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

	<!-- We provide healthy food for your family - Start -->
	<section class="py-5">
		<div class="pt-5"></div>
		<div class="container py-5">
			<div class="pt-5"></div>
			<div class="row">	
				<div class="col-12 col-lg-6" style="position: relative;">
					<img class="img-fluid" style="width: 100%;" src="/admin/gambar/about/<?=$data['gambar_pertama']?>" alt="illustration">
				</div>
				<div class="col-12 col-lg-6">
					<h2><?php echo text($data['judul_english'], $data['judul']); ?></h2>
					<p class="pt-3"><?php echo text($data['deskripsi_english'], $data['deskripsi']); ?></p>
					<a href="<?= $data['brand_book'] ?>" class="btn btn-outline-secondary mt-3"><?= text("View Brand Book", "Lihat Brand Book") ?></a>
				</div>
			</div>
		</div>
	</section>
	<!-- We provide healthy food for your family - End -->
			
	<section class="pt-5">
		<div class="container py-5 d-flex flex-column gap-3">
			<div class="pt-5"></div>
			<h2 class="text-center" style="max-width: 560px; margin: 0 auto"><?= text($data['judul_video'], $data['judul_video_english']) ?></h2>
			<?php 
				$youtube_profile = $data["company_profile"];
				// get the id from the url
				$last_profile = explode("/", $youtube_profile)[3];
				$id_profile = explode("?", $last_profile)[0];
			?>
			<iframe class="img-fluid" style="aspect-ratio: 16/9;" src="https://www.youtube.com/embed/<?= $id_profile ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
		</div>
	</section>
	<?php
	// Array of services with icon, title, and description
	$services = [
			(object)[
					'icon' => '/images/icons/wifi.png',
					'title' => 'Wifi',
					'title_en' => 'Wifi',
					'description' => 'WiFi geratis untuk semua pelanggan.',
					'description_en' => 'Free WiFi available for all customers.',
			],
			(object)[
					'icon' => '/images/icons/indoor-outdoor.png',
					'title' => 'Indoor dan Outdoor',
					'title_en' => 'Indoor and Outdoor',
					'description' => 'Nikmati pilihan tempat duduk indoor dan outdoor.',
					'description_en' => 'Enjoy both indoor and outdoor seating options.',
			],
			(object)[
					'icon' => '/images/icons/location.png',
					'title' => 'Lokasi',
					'title_en' => 'Location',
					'description' => 'Lokasi yang mudah dijangkau untuk Anda.',
					'description_en' => 'Easily accessible location for your convenience.',
			],
			(object)[
					'icon' => '/images/icons/mushola.png',
					'title' => 'Mushola',
					'title_en' => 'Mushola',
					'description' => 'Ruangan sholat tersedia untuk tamu muslim.',
					'description_en' => 'Prayer room available for Muslim guests.',
			],
			(object)[
					'icon' => '/images/icons/parking-area.png',
					'title' => 'Area Parkir',
					'title_en' => 'Parking Area',
					'description' => 'Area parkir yang luas untuk pengunjung.',
					'description_en' => 'Ample parking space for visitors.',
			],
			(object)[
					'icon' => '/images/icons/toilet.png',
					'title' => 'Toilet',
					'title_en' => 'Toilet',
					'description' => 'Toilet yang bersih dan terawat.',
					'description_en' => 'Clean and well-maintained restrooms.',
			],
			(object)[
					'icon' => '/images/icons/view.png',
					'title' => 'Pemandangan',
					'title_en' => 'View',
					'description' => 'Pemandangan yang indah untuk memanjakan Anda.',
					'description_en' => 'Beautiful scenic view to enhance your dining experience.',
			],
			(object)[
					'icon' => '/images/icons/service.png',
					'title' => 'Pelayanan Ramah',
					'title_en' => 'Friendly Service',
					'description' => 'Staf kami menyediakan pelayanan yang ramah dan hangat.',
					'description_en' => 'Our staff provides warm and welcoming service.',
			],
			(object)[
					'icon' => '/images/icons/photo-spot.png',
					'title' => 'Spot Foto',
					'title_en' => 'Photo Spot',
					'description' => 'Tempat-tempat foto yang dipersiapkan untuk Anda.',
					'description_en' => 'Dedicated spots for capturing memorable photos.',
			],
	];
	?>

	<section class="py-5">
			<div class="container py-5">
					<div class="row">
							<?php foreach ($services as $service) : ?>
									<div class="col-12 col-md-6 col-lg-4 mt-3">
											<div class="d-flex gap-3">
													<img style="width: 30px; height: 30px; object-fit: contain;" src="<?= $service->icon ?>" alt="icon"></img>
													<div>
															<h5><?= text($service->title_en, $service->title) ?></h5>
															<p><?= text($service->description_en, $service->description) ?></p>
													</div>
											</div>
									</div>
							<?php endforeach; ?>
					</div>
			</div>
	</section>

	<!-- A little information about the history of Bli Wayan Cafe & Kitchen. - Start -->
	<section class="bg-light pt-5">
		<div class="container py-5">
			<div class="pt-5"></div>
			<div class="row">	
				<div class="col-12 col-lg-7">
					<h2><?php echo text($data['judul_kedua_english'], $data['judul_kedua']); ?></h2>
					<p class="pt-3" style="max-width: 560px;"><?php echo text($data['deskripsi_kedua_english'], $data['deskripsi_kedua']); ?></p>
				</div>
				<div class="col-12 col-lg-5">
					<img class="img-fluid" src="/admin/gambar/about/<?=$data['gambar_kedua'] ?>" alt="illustration">
				</div>
			</div>
		</div>
	</section>
	
	<!-- A little information about the history of Bli Wayan Cafe & Kitchen. - End -->
	<!-- Visit Our PlacesVideo Virtual Reality Tour Of Bli Wayan Cafe & Kitchen - Start -->
	<section class="pt-5">
		<div class="container py-5 d-flex flex-column gap-3">
			<div class="pt-5"></div>
			<h2 class="text-center" style="max-width: 560px; margin: 0 auto"><?= text("Visit Our Places Video Virtual Reality Tour Of Bli Wayan Cafe & Kitchen", "Kunjungi Video Virtual Tour Kami dari Bli Wayan Cafe & Kitchen") ?></h2>
			<?php 
				$youtube = $data["link_youtube"];
				// get the id from the url
				$last = explode("/", $youtube)[3];
				$id = explode("?", $last)[0];
			?>
			<iframe class="img-fluid" style="aspect-ratio: 16/9;" src="https://www.youtube.com/embed/<?= $id ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
		</div>
	</section>
	<!-- Visit Our PlacesVideo Virtual Reality Tour Of Bli Wayan Cafe & Kitchen - End -->
</main>
<?php include '../components/footer.php'; ?>
<?php include '../layout/scripts.php'; ?>
</body>
</html>
