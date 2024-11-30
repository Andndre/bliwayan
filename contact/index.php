<!DOCTYPE html>
<html lang="id">
<?php include '../layout/head.php'; ?>
<body>
<?php 
$_ENV = parse_ini_file('../.env');
?>
<?php include '../components/navbar.php'; ?>
<header class="pt-5">
	<div class="py-5 container">
		<div class="text-center pt-5">
			<h1><?= text("Contact Us", "Hubungi Kami") ?></h1>
			<p style="max-width: 460px; margin: 0 auto"><?= text("We consider all the drivers of change gives you the components you need to change to create a truly happens.", "Kami berusaha untuk memberikan menu yang terbaik untuk Anda") ?></p>
		</div>
	</div>
</header>
<main>
	<div class="container pb-5">
		<div class="row">
			<div class="col-12 col-md-6 pt-5">
			<iframe class="w-100 card" style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15792.478352330496!2d115.1693822!3d-8.290896!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd189b8870c6149%3A0x5df0c93ff0d86b75!2sBli%20Wayan%20Cafe%20%26%20Kitchen!5e0!3m2!1sid!2sid!4v1732947779214!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
			<div class="col-12 col-md-6 pt-5">
				<div class="card shadow">
					<div class="card-body">
						<form id="contactForm" action="/admin/service/sendUserMessage.php" method="POST">
							<div class="d-flex flex-wrap mb-3">
								<div class="me-3 flex-grow-1">
									<label for="name" class="form-label"><?= text("Name", "Nama") ?></label>
									<input type="text" class="form-control" id="name" name="name">
								</div>
								<div class="flex-grow-1">
									<label for="email" class="form-label"><?= text("Email", "Email") ?></label>
									<input type="email" class="form-control" id="email" name="email">
								</div>
							</div>
							<!-- subject -->
							<div class="mb-3">
								<label for="subject" class="form-label"><?= text("Subject", "Subyek") ?></label>
								<input type="text" class="form-control" id="subject" name="subject">
							</div>
							<!-- message in textarea -->
							<div class="mb-3">
								<label for="message" class="form-label"><?= text("Message", "Pesan") ?></label>
								<textarea class="form-control" id="message" rows="3" name="message"></textarea>
							</div>
							<!-- submit button primary -->
							<button  type="submit" class="btn btn-primary w-100"><?= text("Send", "Kirim") ?></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php include '../components/footer.php'; ?>
<?php include '../layout/scripts.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

	// check alert in session
	
	<?php if (isset($_SESSION['alert'])): ?>
		<?php if ($_SESSION['alert'] == 'success'): ?>
			Swal.fire({
				title: '<?= text("Message Sent", "Pesan Terkirim") ?>',
				text: '<?= text("Thank you for contacting us. We will reply to your message as soon as possible.", "Terima kasih telah menghubungi kami. Kami akan membalas pesan Anda secepat mungkin.") ?>',
				icon: 'success',
				allowOutsideClick: false,
				showConfirmButton: false,
				timer: 3000,
			});
		<?php else: ?>
			Swal.fire({
				title: '<?= text("Failed to Send Message", "Gagal Mengirim Pesan") ?>',
				text: '<?= text("Sorry, we are unable to send your message. Please try again later.", "Maaf, kami tidak dapat mengirim pesan Anda. Silakan coba lagi nanti.") ?>',
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
