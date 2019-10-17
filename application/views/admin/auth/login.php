<html>
<head>
	<title>aCMS - Inloggen</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" href="<?= asset_url() ?>css/style.css">

	<style>
		body {
			background-color: #4e73df;
			background-image: -webkit-gradient(linear, left top, left bottom, color-stop(10%, #4e73df), to(#224abe));
			background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
			background-size: cover;
		}
	</style>
</head>
<body id="page-top">
<div class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Inloggen aCMS</h4>
							<div id="infoMessage" style="color: red"><?= $message; ?></div>
							<?= form_open('auth/login', array(
								'class'      => 'my-login-validation',
								'novalidate' => '',
							)); ?>
							<div class="form-group">
								<label for="identity">E-mail</label>
								<?= form_input($identity); ?>
								<div class="invalid-feedback">
									Email is ongeldig
								</div>
							</div>

							<div class="form-group">
								<label for="password">Wachtwoord
<!--									<a href="forgot_password" class="float-right">
										Wachtwoord vergeten?
									</a>-->
								</label>
								<?= form_input($password); ?>
								<div class="invalid-feedback">
									Wachtwoord is verplicht
								</div>
							</div>

							<div class="form-group">
								<div class="custom-checkbox custom-control">
									<?= form_checkbox('remember', '1', false, 'id="remember" class="custom-control-input"'); ?>
									<label for="remember"
									       class="custom-control-label">Aangemeld blijven</label>
								</div>
							</div>

							<div class="form-group m-0">
								<?= form_submit('submit', 'Inloggen', 'class="btn btn-primary btn-block"'); ?>
							</div>
							<?= form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<!-- Bootstrap scrolling nav script -->
<script src="<?= asset_url() ?>js/scrolling-nav.js"></script>
<script src="<?= asset_url() ?>js/jquery.easing.min.js"></script>

<!-- Login form script -->
<script src="<?= asset_url() ?>js/my-login.js"></script>

</body>
</html>