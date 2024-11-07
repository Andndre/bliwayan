<!DOCTYPE html>
<html lang="id">
<?php include '../layout/head.php'; ?>
<body>
<?php 
$_ENV = parse_ini_file('../.env');
?>
<?php include '../components/navbar.php'; ?>
<?php 
	$sql = "SELECT * FROM menus";
	$result = $conn->query($sql);

	$menus = $result->fetch_all(MYSQLI_ASSOC);
?>
<main>
	<header class="pt-5">
		<div class="py-5 container">
			<div class="d-flex justify-content-center pt-5">
				<img style="height: 80px;" src="/images/logo.png" alt="">
				<img style="height: 80px;" src="/images/gegep-coffe.png" alt="">
			</div>
			<div class="text-center pt-4">
				<h1><?= text("Our Menu", "Menu Kami") ?></h1>
				<p style="max-width: 460px; margin: 0 auto"><?= text("We consider all the drivers of change gives you the components you need to change to create a truly happens.", "Kami berusaha untuk memberikan menu yang terbaik untuk anda") ?></p>
			</div>
		</div>
	</header>

	<section id="menus" class="container py-5">
			<div class="row">
					<?php foreach ($menus as $menu) : ?>
							<div class="col-12 col-md-6 col-lg-4 col-xl-3 mt-3">
									<div class="card menu" style="overflow: hidden;">
											<img src="/admin/gambar/menus/<?= $menu['gambar'] ?>" class="card-img-top" alt="menu image">
											<div class="card-body">
													<h5 class="card-title menu"><?= $menu['name'] ?></h5>
													<p><strong class="card-text menu"><?= $menu['harga'] ?></strong></p>
													<p><?= $menu['keterangan'] ?></p>
											</div>
									</div>
							</div>
					<?php endforeach; ?>
			</div>
			<!-- <div class="row text-center pt-5">
				<div class="col-12">
					<button class="btn btn-outline-secondary"><?= text("See More", "Lihat Lebih Banyak") ?></button>
				</div>
			</div> -->
	</section>
</main>
<?php include '../components/footer.php'; ?>
<?php include '../layout/scripts.php'; ?>
</body>
</html>

