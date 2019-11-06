<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Load default head -->
	<?php $this->view('admin/parts/head'); ?>

	<!-- Page title -->
	<title>aCMS - Dashboard</title>
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
				<div class="d-sm-flex align-items-center justify-content-between mb-4">
					<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
					<a href="<?= site_url(); ?>" target="_blank"
					   class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
						<i class="fas fa-external-link-alt fa-sm text-white-50"></i> Bekijk website
					</a>
				</div>

				<!-- Content Row -->
				<div class="row">

					<!-- Content Column -->
					<div class="col-lg-6 mb-4">
						<!-- Illustrations -->
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Welkom terug <?= $_SESSION['first_name']; ?></h6>
							</div>
							<div class="card-body">
								<p>
									Laatste keer dat u ingelogd was op: <strong><?= gmdate("d-m-Y H:i:s", $_SESSION['old_last_login']); ?></strong>
								</p>
							</div>
						</div>
					</div>

					<div class="col-lg-6 mb-4">
						<!-- Approach -->
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">aCMS nieuws & updates</h6>
							</div>
							<div class="card-body">
								<p>
									Er is op dit moment nieuws of belangrijke updates.
								</p>
							</div>
						</div>
					</div>
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

</body>
</html>
