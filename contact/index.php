<!DOCTYPE html>
<html lang="id">
<?php include '../layout/head.php'; ?>
<body>
<?php include '../components/navbar.php'; ?>
<header class="pt-5">
	<div class="py-5 container">
		<div class="text-center pt-5">
			<h1>Contact Us</h1>
			<p style="max-width: 460px; margin: 0 auto">We consider all the drivers of change gives you the components you need to change to create a truly happens.</p>
		</div>
	</div>
</header>
<main>
	<div class="container pb-5">
		<div class="row">
			<div class="col-12 col-md-6 pt-5">
				<iframe class="w-100 card" style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.101937515121!2d115.21279847501494!3d-8.681855691366277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd24121134ee30b%3A0x975ea5444928eebf!2sKopiUNG!5e0!3m2!1sid!2sid!4v1727366244247!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
			<div class="col-12 col-md-6 pt-5">
				<div class="card shadow">
					<div class="card-body">
						<form action="mailto:bliwayan10@icloud.com" method="POST">
							<div class="d-flex flex-wrap mb-3">
								<div class="me-3 flex-grow-1">
									<label for="name" class="form-label">Name</label>
									<input type="text" class="form-control" id="name" name="name">
								</div>
								<div class="flex-grow-1">
									<label for="email" class="form-label">Email</label>
									<input type="email" class="form-control" id="email" name="email">
								</div>
							</div>
							<!-- subject -->
							<div class="mb-3">
								<label for="subject" class="form-label">Subject</label>
								<input type="text" class="form-control" id="subject" name="subject">
							</div>
							<!-- message in textarea -->
							<div class="mb-3">
								<label for="message" class="form-label">Message</label>
								<textarea class="form-control" id="message" rows="3" name="message"></textarea>
							</div>
							<!-- submit button primary -->
							<button  type="submit" class="btn btn-primary w-100">Send</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php include '../components/footer.php'; ?>
<?php include '../layout/scripts.php'; ?>
</body>
</html>
