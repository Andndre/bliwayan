<!DOCTYPE html>
<html lang="id">
<?php include '../layout/head.php'; ?>
<body>
<?php 
$_ENV = parse_ini_file('../.env');
?>
<?php include '../components/navbar.php'; ?>
<header class="pt-5 bg-light">
	<div class="py-5 container">
		<div class="text-center pt-5">
			<h1>Book a Table</h1>
			<p style="max-width: 460px; margin: 0 auto">We consider all the drivers of change gives you the components you need to change to create a truly happens.</p>
		</div>
	</div>
</header>
<main>
	<section class="bg-light d-flex justify-content-center py-5 align-items-center">
		<button class="btn btn-primary mb-5">Booking Now</button>
	</section>
	<section class="pt-5">
		<div class="container py-5 d-flex flex-column gap-3">
			<div class="pt-5"></div>
			<h2 class="text-center" style="max-width: 560px; margin: 0 auto">Visit Our PlacesVideo Virtual Reality Tour Of Bli Wayan Cafe & Kitchen</h2>
			<iframe class="img-fluid" style="aspect-ratio: 16/9;" src="https://www.youtube.com/embed/Mbhm5Z2MPJY?si=nOYEEwWRrR4Irmnb" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
		</div>
	</section>
</main>
<?php include '../components/footer.php'; ?>
<?php include '../layout/scripts.php'; ?>
</body>
</html>
