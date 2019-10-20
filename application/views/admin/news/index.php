<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Load default head -->
	<?php $this->view('admin/parts/head'); ?>

	<!-- Page title -->
	<title>aCMS - Nieuws</title>

	<!-- Custom styles for this page -->
	<link href="<?= asset_url() ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
				<h1 class="h3 mb-2 text-gray-800">Nieuws</h1>
				<p class="mb-4">
					Hier vind u alle nieuws items van de website.
				</p>

				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Alle nieuws items</h6>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
								<tr>
									<th style="width: 25%">Nieuws item</th>
									<th>Laatst bewerkt</th>
									<th>Acties</th>
								</tr>
								</thead>
								<tfoot>
								<tr>
									<th style="width: 25%">Nieuws item</th>
									<th>Laatst bewerkt</th>
									<th>Acties</th>
								</tr>
								</tfoot>
								<tbody>
								<?php foreach ($news as $news_item): ?>
									<tr>
										<td><?= $news_item->news_title; ?></td>
										<td><?= $news_item->updated_on; ?> (door <?= $news_item->first_name; ?>)</td>
										<td>
											<a href="<?= site_url('admin/news/edit/' . $news_item->id) ?>"
											   class="btn btn-warning btn-circle btn-sm">
												<i class="fas fa-edit"></i>
											</a>
											<a href="#" class="btn btn-danger btn-circle btn-sm" data-toggle="modal"
											   data-target="#deleteNewsModal-<?= $news_item->id ?>">
												<i class="fas fa-trash-alt"></i>
											</a>
										</td>
									</tr>

									<!-- Delete page modal -->
									<div class="modal fade" id="deleteNewsModal-<?= $news_item->id ?>" tabindex="-1" role="dialog" aria-labelledby="deletePageLabel"
									     aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="deletePageLabel">Pagina verwijderen</h5>
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
													<a href="<?= site_url('admin/news/del/' . $news_item->id) ?>" class="btn btn-danger">Pagina
														verwijderen</a>
												</div>
											</div>
										</div>
									</div>

								<?php endforeach; ?>
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

<!-- Toastr-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!--Toastr success and error notifications-->
<script src="<?= asset_url() ?>js/toastr-page-edited.js"></script>

</body>
</html>
