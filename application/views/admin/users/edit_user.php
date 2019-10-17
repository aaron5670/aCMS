<!DOCTYPE html>
<html lang="nl">
<head>
	<!-- Load default head -->
	<?php $this->view('admin/parts/head'); ?>

	<!-- Page title -->
	<title>aCMS - Gebruiker aanpassen</title>
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
				<h1 class="h3 mb-2 text-gray-800">Aanpassen gebruiker</h1>
				<p class="mb-4">
					Pas hier de account gegevens aan.
				</p>

				<div class="row">
					<div class="col-6">
						<div id="infoMessage"><?php echo $message;?></div>

						<?php echo form_open(uri_string());?>

						<p>
							<?php echo lang('edit_user_fname_label', 'first_name');?> <br />
							<?php echo form_input($first_name);?>
						</p>

						<p>
							<?php echo lang('edit_user_lname_label', 'last_name');?> <br />
							<?php echo form_input($last_name);?>
						</p>

						<p>
							<?php echo lang('edit_user_company_label', 'company');?> <br />
							<?php echo form_input($company);?>
						</p>

						<p>
							<?php echo lang('edit_user_phone_label', 'phone');?> <br />
							<?php echo form_input($phone);?>
						</p>

						<p>
							<?php echo lang('edit_user_password_label', 'password');?> <br />
							<?php echo form_input($password);?>
						</p>

						<p>
							<?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
							<?php echo form_input($password_confirm);?>
						</p>

						<?php if ($this->ion_auth->is_admin()): ?>

							<h3><?php echo lang('edit_user_groups_heading');?></h3>
							<?php foreach ($groups as $group):?>
								<label class="checkbox">
									<?php
									$gID=$group['id'];
									$checked = null;
									$item = null;
									foreach($currentGroups as $grp) {
										if ($gID == $grp->id) {
											$checked= ' checked="checked"';
											break;
										}
									}
									?>
									<input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
									<?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
								</label>
							<?php endforeach?>

						<?php endif ?>

						<?php echo form_hidden('id', $user->id);?>
						<?php echo form_hidden($csrf); ?>

						<p><?php echo form_submit('submit', lang('edit_user_submit_btn'));?></p>

						<?php echo form_close();?>
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
