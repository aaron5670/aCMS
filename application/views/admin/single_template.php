<!DOCTYPE html>
<html lang="nl">
<head>
	<!-- Load default head -->
	<?php $this->view('admin/parts/head'); ?>

	<!-- Page title -->
	<title>aCMS - <?= $template[0]->template_name; ?></title>

	<!-- Formio.js -->
	<link rel='stylesheet' href='https://unpkg.com/formiojs@latest/dist/formio.full.min.css'>
	<script src='https://unpkg.com/formiojs@latest/dist/formio.full.min.js'></script>
	<script type='text/javascript'>
        window.onload = function () {

            let template = <?= $template[0]->template_json; ?>;

            Formio.createForm(document.getElementById('formio'), template).then(function (form) {
                form.on('submit', (submission) => {
                    console.log(submission);
                    return console.log('The form was just submitted!!!');
                });
                form.on('error', (errors) => {
                    console.log('We have errors!');
                });
            });
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
				<h1 class="h3 mb-2 text-gray-800"><?= $template[0]->template_name; ?></h1>

				<div id='formio'></div>

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

<!--Formio.js-->
<script type="text/javascript">
    var jsonElement = document.getElementById('json');
    var formElement = document.getElementById('formio');
    var subJSON = document.getElementById('subjson');
    var builder = new Formio.FormBuilder(document.getElementById("builder"), {
        display: 'form',
        components: [],
        settings: {
            pdf: {
                "id": "1ec0f8ee-6685-5d98-a847-26f67b67d6f0",
                "src": "https://files.form.io/pdf/5692b91fd1028f01000407e3/file/1ec0f8ee-6685-5d98-a847-26f67b67d6f0"
            }
        }
    }, {
        baseUrl: 'https://examples.form.io'
    });

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
        var jsonElement = document.getElementById('json');
        var formElement = document.getElementById('formio');
        builder.instance.on('saveComponent', onBuild);
        builder.instance.on('editComponent', onBuild);
    };

    var setDisplay = function (display) {
        builder.setDisplay(display).then(onReady);
    };

    // Handle the form selection.
    var formSelect = document.getElementById('form-select');
    formSelect.addEventListener("change", function () {
        setDisplay(this.value);
    });

    builder.instance.ready.then(onReady);
</script>
</body>
</html>
