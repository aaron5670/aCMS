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
				<h1 class="h3 mb-2 text-gray-800">Pagina aanpassen</h1>
				<p class="mb-4">
					Hier kunt u een uw huidige pagina aanpassen.
				</p>

				<div class="row">

					<div class="col-lg-9">

						<div class="form-group">
							<label for="pageTitle">Paginatitel</label>
							<input type="text" name="page-title" value="<?= $pageTitle; ?>" class="form-control"
							       id="pageTitle" autofocus>
						</div>

						<div class="form-group">
							<label for="pageSlug">Slug</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="form-control-sm input-group-text form-slug-control"><?= base_url(); ?></div>
								</div>
								<input type="text" name="page-slug" value="<?= $pageSlug; ?>"
								       class="form-control form-control-sm"
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
											<?php if ($pageStatus === 'published') : ?>
												<option value="published" selected>Publiceren</option>
												<option value="concept">Concept</option>
											<?php else: ?>
												<option value="concept" selected>Concept</option>
												<option value="published">Publiceren</option>
											<?php endif; ?>
										</select>
									</div>
									<a href="#" class="text-danger" data-toggle="modal" data-target="#paginaVerwijderenModal">Pagina verwijderen</a>
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
										<p>Deze pagina gebruikt het template: <b><?= $pageTemplate ?></b></p>
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

<!-- Delete page modal -->
<div class="modal fade" id="paginaVerwijderenModal" tabindex="-1" role="dialog" aria-labelledby="paginaVerwijderenLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="paginaVerwijderenLabel">Pagina verwijderen</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<b>Let op!</b>
				<p>Als je deze pagina verwijderd kan je hem niet meer terug krijgen!</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuleren</button>
				<a href="<?= site_url('admin/pages/del/' . $pageID) ?>" class="btn btn-danger">Pagina verwijderen</a>
			</div>
		</div>
	</div>
</div>

<!-- Logout Modal-->
<?php $this->view('admin/parts/logout_modal'); ?>

<!-- Bootstrap core JavaScript-->
<script src="<?= asset_url() ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= asset_url() ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= asset_url() ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= asset_url() ?>js/sb-admin-2.min.js"></script>

<!-- Ajax request for editing a page with the Formio.js form -->
<script type='text/javascript'>
    window.onload = function () {

        let template = <?= $currentTemplate; ?>;

        Formio.createForm(document.getElementById('contentArea'), template).then(function (form) {
            form.on('submit', (submission) => {

                submission.pageTitle = $("input#pageTitle").val();
                submission.pageSlug = $("input#pageSlug").val();
                // submission.templateId = $('select#template-id').val();
                submission.pageStatus = $('select#page-status').val();
                submission.pageID = <?= $pageID ?>;
                submission.pageTemplateTable = '<?= $pageTemplateTable ?>';

                return $.ajax({
                        url: '/admin/edit/page',
                        type: 'POST',
                        data: submission,
                        error: function (error) {
                            //console.log(error);
                            window.location.replace('/admin/pages/edit/<?= $pageID ?>?message=error');
                        },
                        success: function (data) {
                            window.location.replace('/admin/pages/edit/<?= $pageID ?>?message=success');
                        }
                    }
                );
            });
            form.on('error', (errors) => {
                console.log('There are some errors..');
                console.log(errors);
            });
        });
    };
</script>

<!-- Toastr-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!--Toastr success and error notifications-->
<script src="<?= asset_url() ?>js/toastr-page-edited.js"></script>

</body>
</html>
