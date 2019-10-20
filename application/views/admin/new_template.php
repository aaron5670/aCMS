<!DOCTYPE html>
<html lang="nl">
<head>
	<!-- Load default head -->
	<?php $this->view('admin/parts/head'); ?>

	<!-- Page title -->
	<title>aCMS - Nieuw templates</title>

	<!-- Toastr -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"/>

	<!-- Formio.js -->
	<link rel='stylesheet' href='https://unpkg.com/formiojs@<?= $formioJS_Version; ?>/dist/formio.full.min.css'>
	<script src='https://unpkg.com/formiojs@<?= $formioJS_Version; ?>/dist/formio.full.min.js'></script>

	<script type='text/javascript'>
        window.onload = function () {
            Formio.builder(document.getElementById('builder'), {});
        };
	</script>
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
				<h1 class="h3 mb-2 text-gray-800">Nieuw template</h1>
				<p class="mb-4">
					Maak hier een nieuw template formulier aan.
				</p>

				<?php if (!$unusedTemplates) : ?>
					<b>Maak eerst een nieuw template bestand aan!</b>
					<p>
						Zorg ervoor dat er een nieuw template bestand wordt aangemaakt in <b><?= FCPATH . $siteTheme->site_theme . '\\templates' ?></b>.
						<br />
						Dit bestand moet beginnen met: <b>tpl_</b>
						<br /><br />
						Voorbeeld: <b>tpl_contact.php</b>
					</p>
				<?php elseif(isset($unusedTemplates['error'])): ?>
					<b>Maak eerst een template directory aan in de huidige themes directory!</b>
					<p>
						Zorg ervoor dat dit je templates path wordt: <b><?= FCPATH . $siteTheme->site_theme . '\\templates' ?></b>.
					</p>
				<?php else: ?>
					<form method="post">
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group">
									<label for="templateName">Template naam</label>
									<input type="text" name="templateName" class="form-control" id="templateName"
									       autofocus
									       required>
								</div>
							</div>

							<div class="col-lg-2">
								<div class="form-group">
									<label for="templateFile">
										Template bestand
										<i class="fa fa-info-circle" data-toggle="tooltip" data-html="true"
										   title="Zorg dat er een template bestand is aangemaakt in de huidige thema folder.<br/>Bijvoorbeeld: <b>tpl_contact.php</b>"></i>
									</label>
									<select class="form-control" id="templateFile" name="templateFile">
										<?php foreach ($unusedTemplates as $templateFile) : ?>
											<option value="<?= $templateFile ?>"><?= $templateFile ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="col-lg-2">
								<div class="form-group">
									<label for="form-select">Template type</label>
									<select class="form-control" id="form-select">
										<option value="form">Standaard</option>
										<option value="wizard">Wizard</option>
									</select>
								</div>
							</div>

							<div class="col-lg-2">
								<div class="form-group">
									<label for="isNewsTemplate">Is nieuws item template</label>
									<select class="form-control" id="isNewsTemplate" name="isNewsTemplate">
										<option value="false">Nee</option>
										<option value="true">Ja</option>
									</select>
								</div>
							</div>

							<div class="col-lg-3">
								<div class="form-group">
									<label for="form-select">Template instellingen</label>
									<button type="submit" class="form-control btn btn-success">Template opslaan</button>
								</div>
							</div>
						</div>
					</form>

					<div class="row mt-4">
						<div class="col-sm-8">
							<div id="builder"></div>
						</div>

						<div class="col-sm-4">
							<h3 class="text-center text-muted">JSON Schema</h3>
							<div class="card card-body bg-light jsonviewer">
								<pre id="json"></pre>
							</div>
						</div>
					</div>

					<div class="row mt-4">
						<div class="col-sm-8 offset-sm-2">
							<h3 class="text-center text-muted">
								Voorbeeld
							</h3>
							<div id="formio" class="card card-body bg-light"></div>
						</div>
						<div class="clearfix"></div>
					</div>

					<div class="row mt-4">
						<div class="col-sm-8 offset-sm-2">
							<h3 class="text-center text-muted">Submission JSON</h3>
							<div class="card card-body bg-light jsonviewer">
								<pre id="subjson"></pre>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>

				<?php endif; ?>

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

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!--Formio.js-->
<script src="<?= asset_url() ?>js/ajax/formio-new-template.js"></script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

</body>
</html>
