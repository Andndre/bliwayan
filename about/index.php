<!DOCTYPE html>
<html lang="id">
<?php include '../layout/head.php'; ?>
<body>
<?php include '../components/navbar.php'; ?>
<main>
	<!-- We provide healthy food for your family - Start -->
	<section class="py-5">
		<div class="pt-5"></div>
		<div class="container py-5">
			<div class="pt-5"></div>
			<div class="row">	
				<div class="col-12 col-lg-6" style="position: relative;">
					<img class="img-fluid" style="width: 80%;" src="/images/illustrations/illustration-1.png" alt="illustration">
					<div class="card card-dark" style="position: absolute; bottom: 0; right: 1rem;">
						<div class="card-body w-100" style="max-width: 300px;">
							<h3>Come and visit us</h3>
							<ul class="list-unstyled">
								<li class="d-flex gap-2 align-items-start"><i data-feather="phone-call" class="icon-size"></i> 0815-5848-0000</li>
								<li class="d-flex gap-2 align-items-start"><i data-feather="mail" class="icon-size"></i> <a href="mailto:bliwayan10@icloud.com" style="text-decoration: none; color: white;">bliwayan10@icloud.com</a></li>
								<li class="d-flex gap-2 align-items-start"><i data-feather="map-pin" class="icon-size"></i> Jl. Raya Bedugul, Batunya, Kec. Baturiti, Kabupaten Tabanan, Bali 82191</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-6">
					<h2>We provide healthy food for your family.</h2>
					<p class="pt-3">The story of Bli Wayan Cafe & Kitchen begins with a vision to become a comfortable place to eat, able to satisfy customers, making the taste of the food memorable and hard to forget. Rooted in a rich culinary culture, we strive to honor our local culinary riches while incorporating global flavors.</p>
					<p class="pt-3">At Bli Wayan Cafe & Kitchen, we believe that dining is not just about the food, but also about the entire experience. Our staff, known for their friendliness and dedication, strives to make every visit a memorable moment.</p>
				</div>
			</div>
		</div>
	</section>
	<!-- We provide healthy food for your family - End -->
	<section style="position: relative;">
		<video id="video-profile" src="/images/video-sample.mp4" class="img-fluid" style="width: 100%; object-fit: cover; aspect-ratio: 2/1;"></video>
		<!-- overlay black with text in the center -->
		<div id="overlay-video" class="d-flex justify-content-center align-items-center flex-column" style="width: 100%; height: 100%; position: absolute; top: 0; left: 0; background-color: rgba(0, 0, 0, 0.5); z-index: 1; gap: 1rem">
			<!-- play button -->
			<button id="play-button" class="btn btn-circle btn-white"><i data-feather="play"></i></button>
			<h2 style="color: white;">Feel the authentic & original taste from us</h2>
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
					'description' => 'Free WiFi available for all customers.'
			],
			(object)[
					'icon' => '/images/icons/indoor-outdoor.png',
					'title' => 'Indoor & Outdoor',
					'description' => 'Enjoy both indoor and outdoor seating options.'
			],
			(object)[
					'icon' => '/images/icons/location.png',
					'title' => 'Location',
					'description' => 'Easily accessible location for your convenience.'
			],
			(object)[
					'icon' => '/images/icons/mushola.png',
					'title' => 'Mushola',
					'description' => 'Prayer room available for Muslim guests.'
			],
			(object)[
					'icon' => '/images/icons/parking-area.png',
					'title' => 'Parking Area',
					'description' => 'Ample parking space for visitors.'
			],
			(object)[
					'icon' => '/images/icons/toilet.png',
					'title' => 'Toilet',
					'description' => 'Clean and well-maintained restrooms.'
			],
			(object)[
					'icon' => '/images/icons/view.png',
					'title' => 'View',
					'description' => 'Beautiful scenic view to enhance your dining experience.'
			],
			(object)[
					'icon' => '/images/icons/service.png',
					'title' => 'Friendly Service',
					'description' => 'Our staff provides warm and welcoming service.'
			],
			(object)[
					'icon' => '/images/icons/photo-spot.png',
					'title' => 'Photo Spot',
					'description' => 'Dedicated spots for capturing memorable photos.'
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
															<h5><?= $service->title ?></h5>
															<p><?= $service->description ?></p>
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
					<h2>A little information about the history of Bli Wayan Cafe & Kitchen.</h2>
					<p class="pt-3" style="max-width: 560px;">Bli Wayan Cafe & Kitchen was founded by I Wayan Budiarsana and his wife, Ni Ketut Finna Stefhanie, as a response to the challenges faced during the COVID-19 pandemic, when many businesses were forced to close and visitor restrictions were imposed. They started a small business by selling Nasi Sambal Gege, which received a positive response from the public even though it was just plain yellow rice. This success encouraged them to open a tent stall called Lalapan Tenda Bli Wayan, which was also well received by the local community and grew rapidly. Their main goal is to provide more stable work for staff previously affected by the pandemic. From the success of Lalapan Tenda Bli Wayan, Bli Wayan Cafe & Kitchen was born, a symbol of revival and progress for them as well as a form of appreciation for the staff who have been with them through thick and thin. The name "Bli Wayan" reflects the spirit to rise and move forward from the experiences that have been experienced.</p>
				</div>
				<div class="col-12 col-lg-5">
					<img class="img-fluid" src="/images/history.png" alt="illustration">
				</div>
			</div>
		</div>
	</section>
	<!-- A little information about the history of Bli Wayan Cafe & Kitchen. - End -->
	<!-- Visit Our PlacesVideo Virtual Reality Tour Of Bli Wayan Cafe & Kitchen - Start -->
	<section class="pt-5">
		<div class="container py-5 d-flex flex-column gap-3">
			<div class="pt-5"></div>
			<h2 class="text-center" style="max-width: 560px; margin: 0 auto">Visit Our PlacesVideo Virtual Reality Tour Of Bli Wayan Cafe & Kitchen</h2>
			<iframe class="img-fluid" style="aspect-ratio: 16/9;" src="https://www.youtube.com/embed/Mbhm5Z2MPJY?si=nOYEEwWRrR4Irmnb" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
		</div>
	</section>
	<!-- Visit Our PlacesVideo Virtual Reality Tour Of Bli Wayan Cafe & Kitchen - End -->
</main>
<?php include '../components/footer.php'; ?>
<?php include '../layout/scripts.php'; ?>
</body>
</html>
