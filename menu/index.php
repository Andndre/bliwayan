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
				<h1>Our Menu</h1>
				<p style="max-width: 460px; margin: 0 auto">We consider all the drivers of change gives you the components you need to change to create a truly happens.</p>
			</div>
		</div>
	</header>
	<?php
	// Ambil dari database
	$menus = [
			(object)[
					'image' => '/images/illustrations/sample-menu.png',
					'price' => 'Rp 20.000',
					'title' => 'Fried Eggs',
					'description' => 'Made with eggs, lettuce, salt, oil and other ingredients.'
			],
			(object)[
					'image' => '/images/illustrations/sample-menu.png',
					'price' => 'Rp 35.000',
					'title' => 'Chicken Salad',
					'description' => 'Grilled chicken, fresh veggies, and light dressing.'
			],
			(object)[
					'image' => '/images/illustrations/sample-menu.png',
					'price' => 'Rp 50.000',
					'title' => 'Steak & Fries',
					'description' => 'Juicy steak served with golden fries.'
			],
			(object)[
					'image' => '/images/illustrations/sample-menu.png',
					'price' => 'Rp 15.000',
					'title' => 'Pancakes',
					'description' => 'Fluffy pancakes served with syrup and butter.'
			],
			(object)[
					'image' => '/images/illustrations/sample-menu.png',
					'price' => 'Rp 20.000',
					'title' => 'Fried Eggs',
					'description' => 'Made with eggs, lettuce, salt, oil and other ingredients.'
			],
			(object)[
					'image' => '/images/illustrations/sample-menu.png',
					'price' => 'Rp 35.000',
					'title' => 'Chicken Salad',
					'description' => 'Grilled chicken, fresh veggies, and light dressing.'
			],
			(object)[
					'image' => '/images/illustrations/sample-menu.png',
					'price' => 'Rp 50.000',
					'title' => 'Steak & Fries',
					'description' => 'Juicy steak served with golden fries.'
			],
			(object)[
					'image' => '/images/illustrations/sample-menu.png',
					'price' => 'Rp 15.000',
					'title' => 'Pancakes',
					'description' => 'Fluffy pancakes served with syrup and butter.'
			]
	];
	?>

	<section id="menus" class="container py-5">
			<div class="row">
					<?php foreach ($menus as $menu) : ?>
							<div class="col-12 col-md-6 col-lg-4 col-xl-3 mt-3">
									<div class="card menu">
											<img src="<?= $menu->image ?>" class="card-img-top" alt="menu image">
											<div class="card-body">
													<h5 class="card-title menu"><?= $menu->price ?></h5>
													<p><strong class="card-text menu"><?= $menu->title ?></strong></p>
													<p><?= $menu->description ?></p>
											</div>
									</div>
							</div>
					<?php endforeach; ?>
			</div>
			<div class="row text-center pt-5">
				<div class="col-12">
					<button class="btn btn-outline-secondary">View More Menu</button>
				</div>
			</div>
	</section>
</main>
<?php include '../components/footer.php'; ?>
<?php include '../layout/scripts.php'; ?>
</body>
</html>
