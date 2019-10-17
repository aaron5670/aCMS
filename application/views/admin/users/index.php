<!DOCTYPE html>
<html lang="nl">
<head>
	<!-- Load default head -->
	<?php $this->view('admin/parts/head'); ?>

	<!-- Page title -->
	<title>aCMS - Gebruikers</title>

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

				<?php if ($message) : ?>
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Holy guacamole!</strong> <?= $message ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php endif; ?>

				<!-- Page Heading -->
				<h1 class="h3 mb-2 text-gray-800">Alle gebruikers</h1>
				<p class="mb-4">
					Een overzicht van alle gebruikers.

					<button type="button" class="btn btn-outline-primary float-right" data-toggle="modal"
					        data-target="#newUserModal">
						Nieuwe gebruiker
					</button>
				</p>

				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Alle gebruikers</h6>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
								<tr>
									<th>Voornaam</th>
									<th>Achternaam</th>
									<th>E-mail</th>
									<th>Rol</th>
									<th>Status</th>
									<th>Acties</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($users as $user): ?>
									<tr>
										<td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
										<td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
										<td>
											<?php foreach ($user->groups as $group): ?>
												<?php echo anchor("admin/users/editGroup/" . $group->id, htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8')); ?>
												<br/>
											<?php endforeach ?>
										</td>
										<td><?php echo ($user->active) ? anchor("admin/users/deactivateUser/" . $user->id, lang('index_active_link')) : anchor("admin/users/activateUser/" . $user->id, lang('index_inactive_link')); ?></td>
										<td><?php echo anchor("admin/users/editUser/" . $user->id, 'Edit'); ?></td>
									</tr>
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

<!-- Modal -->
<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel"
     aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="newUserModalLabel">Nieuwe gebruiker toevoegen</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php echo form_open("admin/users"); ?>

			<div class="modal-body">

				<div class="form-group">
					<div class="row">
						<div class="col">
							<?php echo lang('create_user_fname_label', 'first_name'); ?> <br/>
							<?php echo form_input($first_name, '', ''); ?>
						</div>

						<div class="col">
							<?php echo lang('create_user_lname_label', 'last_name'); ?> <br/>
							<?php echo form_input($last_name); ?>
						</div>
					</div>
				</div>

				<?php
				if ($identity_column !== 'email') {
					echo '<p>';
					echo lang('create_user_identity_label', 'identity');
					echo '<br />';
					echo form_error('identity');
					echo form_input($identity);
					echo '</p>';
				}
				?>

				<div class="form-group">
					<?php echo lang('create_user_company_label', 'company'); ?> <br/>
					<?php echo form_input($company); ?>
				</div>

				<div class="form-group">
					<?php echo lang('create_user_email_label', 'email'); ?> <br/>
					<?php echo form_input($email); ?>
				</div>

				<div class="form-group">
					<?php echo lang('create_user_phone_label', 'phone'); ?> <br/>
					<?php echo form_input($phone); ?>
				</div>

				<div class="row">
					<div class="col">
						<?php echo lang('create_user_password_label', 'password'); ?> <br/>
						<?php echo form_input($password); ?>
					</div>

					<div class="col">
						<?php echo lang('create_user_password_confirm_label', 'password_confirm'); ?> <br/>
						<?php echo form_input($password_confirm); ?>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<?php
				$data = array(
					'data'  => 'submit',
					'value' => lang('create_user_submit_btn'),
					'class' => 'btn btn-primary',
				);
				echo form_submit($data); ?>
			</div>
			<?php echo form_close(); ?>
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

<!-- Page level plugins -->
<script src="<?= asset_url() ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= asset_url() ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= asset_url() ?>js/demo/datatables-demo.js"></script>

</body>
</html>
