<!DOCTYPE html>
<html lang="id">
<?php include '../layout/head.php'; ?>
<body>
<?php include '../components/navbar.php'; ?>
<main>
	<header class="pt-5">
		<div class="py-5 container">
			<div class="d-flex justify-content-center pt-5">
				<img style="height: 80px;" src="/images/logo.png" alt="">
				<img style="height: 80px;" src="/images/gegep-coffe.png" alt="">
			</div>
			<div class="text-center pt-4">
				<h1>Our Photo & Video</h1>
				<p style="max-width: 460px; margin: 0 auto">We consider all the drivers of change gives you the components you need to change to create a truly happens.</p>
			</div>
		</div>
	</header>
	<?php
	// Ambil dari database
	$gallery = [
			(object)[
					'image' => '/images/illustrations/sample-menu.png',
			],
			(object)[
					'image' => '/images/illustrations/sample-menu.png',
			],
			(object)[
					'image' => '/images/illustrations/sample-menu.png',
			],
			(object)[
					'image' => '/images/illustrations/sample-menu.png',
			],
			(object)[
					'image' => '/images/illustrations/sample-menu.png',
			],
			(object)[
					'image' => '/images/illustrations/sample-menu.png',
			],
			(object)[
					'image' => '/images/illustrations/sample-menu.png',
			],
			(object)[
					'image' => '/images/illustrations/sample-menu.png',
			]
	];
	?>

	<section id="menus" class="container py-5">
			<div class="row pb-5">
					<?php foreach ($gallery as $item) : ?>
							<div class="col-12 col-md-6 col-lg-4 col-xl-3 mt-3">
									<div class="card" style="overflow: hidden;">
											<img src="<?= $item->image ?>" class="card-img-top" alt="gallery image">
									</div>
							</div>
					<?php endforeach; ?>
			</div>
	</section>
</main>
<?php include '../components/footer.php'; ?>
<?php include '../layout/scripts.php'; ?>
</body>
</html>
