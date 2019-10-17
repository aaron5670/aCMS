<!DOCTYPE html>
<html lang="nl">
<head>
	<!-- Load default head -->
	<?php $this->view('admin/parts/head'); ?>

	<!-- Page title -->
	<title>aCMS - Templates aanpassen</title>

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
				<h1 class="h3 mb-2 text-gray-800">Template aanpassen</h1>
				<p class="mb-4">
					<span class="alert-danger">
						<b>Let op:</b>
						als je een template aanpast worden alle huidige pagina's die dit template gebruiken verwijderd uit de database!
					</span>
				</p>
				<form method="post">
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="templateName">Template naam <i class="text-danger">(kan niet aangepast
										worden)</i></label>
								<input type="text" name="templateName" class="form-control" id="templateName"
								       value="<?= $template[0]->template_name; ?>" readonly>
							</div>
						</div>

						<div class="col-lg-3 offset-lg-5">
							<div class="form-group">
								<label for="form-select">Template instellingen</label>
								<button type="submit" class="form-control btn btn-outline-danger">Template opslaan
								</button>
								<span class="alert-warning">
						<b>Let op:</b>
						Zorg voordat je het template opslaat de JSON is geüpdatet
					</span>
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
							<pre id="json">
								<?= $template[0]->template_json; ?>
							</pre>
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
<script>
    var jsonElement = document.getElementById('json');
    var formElement = document.getElementById('formio');
    var subJSON = document.getElementById('subjson');

    let template = <?= $template[0]->template_json; ?>;

    var builder = new Formio.FormBuilder(document.getElementById('builder'), template);

    var onForm = function (form) {
        form.on('change', function () {
            subJSON.innerHTML = '';
            subJSON.appendChild(document.createTextNode(JSON.stringify(form.submission, null, 4)));
        });
    };

    var onBuild = function (build) {
        jsonElement.innerHTML = '';
        formElement.innerHTML = '';
        jsonElement.appendChild(document.createTextNode(JSON.stringify(builder.instance.schema, null, 4)));
        Formio.createForm(formElement, builder.instance.form).then(onForm);
    };

    var onReady = function () {
        builder.instance.on('saveComponent', onBuild);
        builder.instance.on('editComponent', onBuild);
    };

    var setDisplay = function (display) {
        builder.setDisplay(display).then(onReady);
    };

    builder.instance.ready.then(onReady);

    $('form').submit(function (e) {
        e.preventDefault();

        var jsonElement = document.getElementById('json');

        var data = {
            templateID: <?= $template[0]->id; ?>,
            templateTableName: '<?= $template[0]->template_table_name; ?>',
            jsonElement: jsonElement.innerHTML,
        };

        $.ajax({
            url: '/admin/templates/editTemplatePost',
            type: 'POST',
            data: data,
            error: function (error) {
                // $('html').html(error);
                console.log(error)
                toastr["warning"]("Er is iets fout gegaan. Probeer het nog is...", "Oeps");

                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "2500",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            },
            success: function (response) {
                // $('html').html(response);
                window.location.replace('/admin/templates?message=successfully-added');
            }
        });
    });
</script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

</body>
</html>
