<!DOCTYPE html>
<html lang="id">
<?php include '../layout/head.php'; ?>
<body>
<?php 
$_ENV = parse_ini_file('../.env');
?>
<?php include '../components/navbar.php'; ?>
<main>
	<header class="pt-5">
		<div class="py-5 container">
			<div class="d-flex justify-content-center pt-5">
				<img style="height: 80px;" src="/images/logo.png" alt="">
				<img style="height: 80px;" src="/images/gegep-coffe.png" alt="">
			</div>
			<div class="text-center pt-4">
				<h1><?= text("Our Photo & Video", "Galeri Kami") ?></h1>
				<!-- <p style="max-width: 460px; margin: 0 auto">We consider all the drivers of change gives you the components you need to change to create a truly happens.</p> -->
				<p style="max-width: 460px; margin: 0 auto"><?= text("We consider all the drivers of change gives you the components you need to change to create a truly happens.", "Kami berusaha untuk memberikan menu yang terbaik untuk Anda") ?></p>
			</div>
		</div>
	</header>
	<?php
		$sql = "SELECT * FROM gallerys";
		$result = $conn->query($sql);

		$gallery = $result->fetch_all(MYSQLI_ASSOC);
	?>

	<section id="menus" class="container py-5">
			<div class="row pb-5">
					<?php foreach ($gallery as $item) : ?>
							<div class="col-12 col-md-6 col-lg-4 col-xl-3 mt-3">
									<div class="card" style="overflow: hidden;">
										<div style="position: relative; width: 100%; padding-bottom: 100%">
											<?php if ($item['jenis'] == "foto") : ?>
												<img src="/admin/gambar/gallerys/<?=$item['file'] ?>" class="card-img-top" alt="gallery image" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; height: 100%; object-fit: cover;">
											<?php else : ?>
												<video src="/admin/gambar/gallerys/<?=$item['file'] ?>" class="card-img-top" controls style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; height: 100%; object-fit: cover;"></video>
											<?php endif; ?>
										</div>
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
