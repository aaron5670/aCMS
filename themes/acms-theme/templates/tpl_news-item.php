<html lang="en">
<head>
	<title>aCMS - <?= $page_title ?></title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<style>
		header {
			position: relative;
			background-color: black;
			height: 75vh;
			min-height: 25rem;
			width: 100%;
			overflow: hidden;
		}

		header video {
			position: absolute;
			top: 50%;
			left: 50%;
			min-width: 100%;
			min-height: 100%;
			width: auto;
			height: auto;
			z-index: 0;
			-ms-transform: translateX(-50%) translateY(-50%);
			-moz-transform: translateX(-50%) translateY(-50%);
			-webkit-transform: translateX(-50%) translateY(-50%);
			transform: translateX(-50%) translateY(-50%);
		}

		header .container {
			position: relative;
			z-index: 2;
		}

		header .overlay {
			position: absolute;
			top: 0;
			left: 0;
			height: 100%;
			width: 100%;
			background-color: black;
			opacity: 0.5;
			z-index: 1;
		}

		@media (pointer: coarse) and (hover: none) {
			header {
				background: url('https://source.unsplash.com/XT5OInaElMw/1600x900') black no-repeat center center scroll;
			}

			header video {
				display: none;
			}
		}
	</style>
</head>
<body class="d-flex flex-column">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
	<div class="container">
		<a class="navbar-brand" href="<?= site_url() ?>">aCMS Theme</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home
						<span class="sr-only">(current)</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Services</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Contact</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<header>
	<div class="overlay"></div>
	<video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
		<source src="https://storage.googleapis.com/coverr-main/mp4/Mt_Baker.mp4" type="video/mp4">
	</video>
	<div class="container h-100">
		<div class="d-flex h-100 text-center align-items-center">
			<div class="w-100 text-white">
				<h1 class="display-3"><?= $pageTitle ?></h1>
			</div>
		</div>
	</div>
</header>

<section class="my-5">
	<div class="container pb-5">
		<div class="row">
			<div class="col-md-8 mx-auto">
				<?= $content ?>
			</div>
		</div>
	</div>
</section>

<footer id="sticky-footer" class="py-4 bg-dark text-white-50">
	<div class="container text-center">
		<small>&copy; Copyright aCMS</small>
	</div>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>
