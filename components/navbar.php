<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="/images/logo.png" alt="" height="60">
    </a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link <?= $_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/index.php' ? 'active' : '' ?>" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], 'about') !== false) ? 'active' : '' ?>" href="/about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], 'menu') !== false) ? 'active' : '' ?>" href="/menu">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], 'gallery') !== false) ? 'active' : '' ?>" href="/gallery">Gallery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (strpos($_SERVER['REQUEST_URI'], 'contact') !== false) ? 'active' : '' ?>" href="/contact">Contact</a>
        </li>
      </ul>
			<div class="navbar-nav ml-auto">
				<div class="nav-item">
					<a class="btn btn-outline-secondary" href="/book-now/">Book a Table</a>
				</div>
			</div>
    </div>
  </div>
</nav>
