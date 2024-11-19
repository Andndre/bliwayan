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
					<h2><?php echo text($data['judul'], $data['judul_english']); ?></h2>
					<p class="pt-3"><?php echo text($data['deskripsi'], $data['deskripsi_english']); ?></p>
				</div>
			</div>
		</div>
	</section>
	<!-- We provide healthy food for your family - End -->
	<section style="position: relative;">
		<video id="video-profile" src="/admin/gambar/about/<?=$data['video']?>" class="img-fluid" style="width: 100%; object-fit: cover; aspect-ratio: 2/1;"></video>
		<!-- overlay black with text in the center -->
		<div id="overlay-video" class="d-flex justify-content-center align-items-center flex-column" style="width: 100%; height: 100%; position: absolute; top: 0; left: 0; background-color: rgba(0, 0, 0, 0.5); z-index: 1; gap: 1rem">
			<!-- play button -->
			<button id="play-button" class="btn btn-circle btn-white"><i data-feather="play"></i></button>
			<h2 style="color: white;"><?= text($data["judul_video_english"], $data["judul_video"]) ?></h2>
			<script>
				$('#play-button').click(function() {
					$('#video-profile').get(0).play();
					$('#overlay-video').fadeOut("slow", "linear", function() {
						$('#overlay-video').remove();
					});
				})
			</script>
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
					<h2><?php echo text($data['judul_kedua'], $data['judul_kedua_english']); ?></h2>
					<p class="pt-3" style="max-width: 560px;"><?php echo text($data['deskripsi_kedua'], $data['deskripsi_kedua_english']); ?></p>
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
