<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Load default head -->
	<?php $this->view('admin/parts/head'); ?>

	<!-- Page title -->
	<title>aCMS - Pagina aanmaken</title>

	<!-- Formio.js -->
	<link rel='stylesheet' href='https://unpkg.com/formiojs@latest/dist/formio.full.min.css'>
	<script src='https://unpkg.com/formiojs@latest/dist/formio.full.min.js'></script>

	<!-- Toastr -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>
</head>

<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">

	<!-- Sidebar -->
	<?php $this->view('admin/parts/sidebar'); ?>
	<!-- End of Sidebar -->

	<div id="content-wrapper" class="d-flex flex-column">

		<div id="content">

			<!-- Topbar -->
			<?php $this->view('admin/parts/topbar'); ?>
			<!-- End of Topbar -->

			<div class="container-fluid">
				<h1 class="h3 mb-2 text-gray-800">Nieuwe pagina aanmaken</h1>
				<p class="mb-4">
					Hier kunt u een nieuwe pagina aanmaken voor uw website.
				</p>

				<div class="row">

					<div class="col-lg-9">

						<div class="form-group">
							<label for="pageTitle">Paginatitel</label>
							<input type="text" name="page-title" class="form-control" id="pageTitle" autofocus>
						</div>

						<div class="form-group">
							<label for="pageSlug">Slug</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="form-control-sm input-group-text form-slug-control font-weight-bold"><?= base_url(); ?></div>
								</div>
								<input type="text" name="page-slug" class="form-control form-control-sm"
								       aria-describedby="pageSlugHelp" id="pageSlug" onBlur="checkAvailability()">
								<div id="feedback"></div>
							</div>
							<small id="pageSlugHelp" class="form-text text-muted">
								<i class="fas fa-spinner fa-spin" id="loaderIcon" style="display: none;"></i>
								De pagina slug (url) moet uniek zijn.
							</small>
						</div>

						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Content</h6>
							</div>
							<div class="card-body">
								<div id='contentArea'></div>
							</div>
						</div>

					</div>

					<div class="col-lg-3">
						<div class="card shadow mb-4">
							<a href="#pageSettings" class="d-block card-header py-3 collapsed"
							   data-toggle="collapse" role="button" aria-expanded="false"
							   aria-controls="pageSettings">
								<h6 class="m-0 font-weight-bold text-primary">Pagina instellingen</h6>
							</a>
							<div class="collapse show" id="pageSettings" style="">
								<div class="card-body">
									<div class="form-group">
										<label for="page-status">Pagina status</label>
										<select class="form-control" id="page-status" name="page-status">
											<option value="published" selected>Publiceren</option>
											<option value="concept">Concept</option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="card shadow mb-4">
							<a href="#templateSettings" class="d-block card-header py-3"
							   data-toggle="collapse" role="button" aria-expanded="false"
							   aria-controls="templateSettings">
								<h6 class="m-0 font-weight-bold text-primary">Template instellingen</h6>
							</a>
							<div id="templateSettings" style="">
								<div class="card-body">
									<div class="form-group">
										<?php if (!$templates): ?>
											<p><i>Geen templates beschikbaar.</i></p>
										<?php else: ?>
											<label for="template-id">Pagina template</label>
											<select class="form-control" id="template-id" name="template-id">
												<?php foreach ($templates as $template): ?>
													<option value="<?= $template->id ?>"
													        selected><?= $template->template_name ?></option>
												<?php endforeach; ?>
											</select>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Footer -->
		<?php $this->view('admin/parts/footer'); ?>
		<!-- End of Footer -->

	</div>

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

<!-- Ajax post request for new page with the Formio.js form -->
<script src="<?= asset_url() ?>js/ajax/post-new-page.js"></script>

<!-- Toastr-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!--Toastr success and error notifications-->
<script src="<?= asset_url() ?>js/toastr-page-edited.js"></script>

<!--Page slug input spacebar to dash (-) converter & slug availability checker -->
<script src="<?= asset_url() ?>js/ajax/slug-availability-checker.js"></script>

</body>
</html>
