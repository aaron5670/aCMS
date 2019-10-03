<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Load default head -->
	<?php $this->view('admin/parts/head'); ?>

	<!-- Page title -->
	<title>aCMS - Alle pagina's</title>

	<!-- Custom styles for this page -->
	<link href="<?= asset_url() ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
				<h1 class="h3 mb-2 text-gray-800">Mijn pagina's</h1>
				<p class="mb-4">
					Hier vind u al uw pagina's van de website.
				</p>

				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Alle pagina's</h6>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
								<tr>
									<th style="width: 25%">Pagina</th>
									<th style="width: 20%">Pagina template</th>
									<th>Laatst bewerkt</th>
									<th style="width: 10%">Gepubliceerd</th>
									<th>Acties</th>
								</tr>
								</thead>
								<tfoot>
								<tr>
									<th>Pagina</th>
									<th>Pagina template</th>
									<th>Laatst bewerkt</th>
									<th>Gepubliceerd</th>
									<th>Acties</th>
								</tr>
								</tfoot>
								<tbody>
								<?php foreach ($pages as $page): ?>
									<tr>
										<td><?= $page->page_title; ?></td>
										<td><?= $page->template_name; ?></td>
										<td><?= $page->updated_on; ?> (door <?= $page->first_name; ?>)</td>
										<td><i class="btn btn-success btn-circle btn-sm fas fa-check-circle"></i></td>
										<td>
											<a href="<?= site_url($page->slug) ?>" class="btn btn-success btn-circle btn-sm" target="_blank">
												<i class="fas fa-external-link-alt"></i>
											</a>
											<a href="#" class="btn btn-warning btn-circle btn-sm">
												<i class="fas fa-edit"></i>
											</a>
											<a href="#" class="btn btn-danger btn-circle btn-sm">
												<i class="fas fa-trash-alt"></i>
											</a>
										</td>
									</tr>
								<?php endforeach; ?>
<!--								<tr>
									<td>Contact</td>
									<td>/contact</td>
									<td><?/*= date('m-d-Y') */?> (door Gerrit)</td>
									<td><i class="btn btn-danger btn-circle btn-sm fas fa-times-circle"></i></td>
									<td>
										<a href="#" class="btn btn-warning btn-circle btn-sm">
											<i class="fas fa-edit"></i>
										</a>
										<a href="#" class="btn btn-success btn-circle btn-sm">
											<i class="fas fa-external-link-alt"></i>
										</a>
									</td>
								</tr>-->
								</tbody>
							</table>
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

<!-- Page level plugins -->
<script src="<?= asset_url() ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= asset_url() ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= asset_url() ?>js/demo/datatables-demo.js"></script>

</body>
</html>
