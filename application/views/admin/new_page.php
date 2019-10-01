<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Load default head -->
	<?php $this->view('admin/parts/head'); ?>

	<!-- Page title -->
	<title>aCMS - Pagina aanmaken</title>

	<!-- Toastr -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
</head>

<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">

	<!-- Sidebar -->
	<?php $this->view('admin/parts/sidebar'); ?>
	<!-- End of Sidebar -->

	<!-- Content Wrapper -->
	<div id="content-wrapper" class="d-flex flex-column">

		<!-- Main Content -->
		<div id="content">

			<!-- Topbar -->
			<?php $this->view('admin/parts/topbar'); ?>
			<!-- End of Topbar -->

			<div class="container-fluid">
				<form method="post">

					<!-- Page Heading -->
					<h1 class="h3 mb-2 text-gray-800">Nieuwe pagina aanmaken</h1>
					<p class="mb-4">
						Hier kunt u een nieuwe pagina aanmaken voor uw website.
					</p>

					<div class="row">

						<div class="col-lg-8">

							<div class="form-group">
								<label for="pageTitle">Paginatitel</label>
								<input type="text" name="page-title" class="form-control" id="pageTitle" autofocus>
							</div>

							<div class="form-group">
								<label for="pageSlug">Slug</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="form-control-sm input-group-text form-slug-control"><?= base_url(); ?></div>
									</div>
									<input type="text" name="page-slug" class="form-control form-control-sm"
									       aria-describedby="pageSlugHelp" id="pageSlug">
								</div>
								<small id="pageSlugHelp" class="form-text text-muted">De pagina slug (url) moet uniek
									zijn.</small>
							</div>

							<div class="card shadow mb-4">
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary">Content</h6>
								</div>
								<div class="card-body">
									<p>Hier komt de editor.</p>
								</div>
							</div>

						</div>

						<div class="col-lg-4">

							<div class="card shadow mb-4">
								<a href="#pageSettings" class="d-block card-header py-3 collapsed"
								   data-toggle="collapse" role="button" aria-expanded="false"
								   aria-controls="pageSettings">
									<h6 class="m-0 font-weight-bold text-primary">Pagina instellingen</h6>
								</a>
								<div class="collapse show" id="pageSettings" style="">
									<div class="card-body">
										<p>Hier komen pagina instellingen.</p>
										<button type="submit" class="btn btn-info">Publiceren</button>
									</div>
								</div>
							</div>

							<div class="card shadow mb-4">
								<a href="#templateSettings" class="d-block card-header py-3 collapsed"
								   data-toggle="collapse" role="button" aria-expanded="false"
								   aria-controls="templateSettings">
									<h6 class="m-0 font-weight-bold text-primary">Template instellingen</h6>
								</a>
								<div class="collapse" id="templateSettings" style="">
									<div class="card-body">
										<p>Hier komen template instellingen.</p>
									</div>
								</div>
							</div>

						</div>
					</div>
				</form>
			</div>

		</div>
		<!-- End of Main Content -->

		<!-- Footer -->
		<?php $this->view('admin/parts/footer'); ?>
		<!-- End of Footer -->

	</div>
	<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<?php $this->view('admin/parts/logout_modal'); ?>

<!-- Bootstrap core JavaScript-->
<script src="<?= asset_url() ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= asset_url() ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= asset_url() ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= asset_url() ?>js/sb-admin-2.min.js"></script>

<!-- Toastr-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- Ajax post request -->
<script src="<?= asset_url() ?>js/ajax/post-new-page.js"></script>

</body>
</html>