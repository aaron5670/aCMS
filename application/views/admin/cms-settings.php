<!DOCTYPE html>
<html lang="nl">
<head>
	<!-- Load default head -->
	<?php $this->view('admin/parts/head'); ?>

	<!-- Page title -->
	<title>aCMS - aCMS instellingen</title>

	<!-- Toastr -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>
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

			<!-- Begin Page Content -->
			<div class="container-fluid">

				<!-- Page Heading -->
				<h1 class="h3 mb-2 text-gray-800">aCMS instellingen</h1>
				<p class="mb-4">
					Pas hier de instellingen van het CMS en de website aan.
				</p>

				<form id="settingsForm" method="post">

					<div class="row">
						<div class="col-md-6">
							<div class="card shadow mb-4">
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary">Algemene instellingen</h6>
								</div>
								<div class="card-body">
									<div class="form-group">
										<label for="website-title">Website titel</label>
										<input type="text" class="form-control" id="website-title" name="siteTitle"
										       value="<?= $settings->site_title ?>"
										       aria-describedby="websiteTitleHelp">
										<small id="websiteTitleHelp" class="form-text text-muted">Dit past de naam van
											de gehele website aan.</small>
									</div>
									<div class="form-group">
										<label for="website-cms-template">Website template</label>
										<select class="form-control" id="website-cms-template" name="siteTheme"
										        aria-describedby="websiteTemplateHelp">
											<?php
											foreach ($themes as $theme) :
												if ($theme === $settings->site_theme) : ?>
													<option value="<?= $theme; ?>"
													        selected><?= ucfirst(str_replace('themes\\', "", $theme)); ?></option>
												<?php else: ?>
													<option value="<?= $theme; ?>"><?= ucfirst(str_replace('themes\\', "", $theme)); ?></option>
												<?php endif; ?>
											<?php endforeach; ?>
										</select>
										<small id="websiteTemplateHelp" class="form-text text-muted">
											<strong>Let op:</strong> Dit verandert de gehele layout van de website! <u>Maak
												eerst een backup!</u>
										</small>
									</div>
									<button type="submit" class="btn btn-primary">Opslaan</button>
								</div>
							</div>

						</div>

						<div class="col-md-6">
							<div class="card shadow mb-4">
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-bold text-primary">Nieuws instellingen</h6>
								</div>
								<div class="card-body">
									<div class="form-group">
										<label for="siteNewspage">Nieuwspagina</label>
										<select class="form-control" id="siteNewspage" name="siteNewspage"
										        aria-describedby="siteNewspageHelp">
											<?php foreach ($pages as $page) :
												if ($page->is_newspage == true) : ?>
													<option value="<?= $page->page_id ?>"
													        selected><?= $page->page_title ?></option>
												<?php elseif ($page->is_homepage != true): ?>
													<option value="<?= $page->page_id ?>"><?= $page->page_title ?></option>
												<?php endif; ?>
											<?php endforeach; ?>
										</select>
										<small id="siteNewspageHelp" class="form-text text-muted">
											<strong>Let op:</strong> Dit verandert de nieuwspagina van de website!
											<u>Doe dit niet zomaar!</u>
										</small>
									</div>
									<button type="submit" class="btn btn-primary">Opslaan</button>
								</div>
							</div>
						</div>
					</div>

				</form>

			</div>
			<!-- /.container-fluid -->

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

<!-- Ajax post request changing settings -->
<script src="<?= asset_url() ?>js/ajax/change-cms-settings.js"></script>

</body>
</html>
