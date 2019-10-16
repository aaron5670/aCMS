<!DOCTYPE html>
<html lang="nl">
<head>
	<!-- Load default head -->
	<?php $this->view('admin/parts/head'); ?>

	<!-- Page title -->
	<title>aCMS - Menu</title>

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
				<h1 class="h3 mb-2 text-gray-800">Menubeheer</h1>
				<p class="mb-4">
					Pas hier het menu van de website aan.
				</p>

				<div class="row">
					<div class="col-12 col-md-4">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Pagina aan het menu toevoegen</h6>
							</div>
							<div class="card-body">
								<form action="<?= site_url('admin/menu/addMenuItem'); ?>" id="add-menu-items-form"
								      method="post">
									<div class="form-group row">
										<label for="menu-item-page-id" class="col-sm-4 col-form-label">Pagina</label>
										<div class="col-sm-8">
											<select class="form-control" id="menu-item-page-id"
											        name="menu-item-page-id">
												<?php foreach ($pages as $page) : ?>
													<option value="<?= $page->id ?>"><?= $page->page_title ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="checkbox" id="menu-item-target"
										       name="menu-item-target"
										       value="_blank">
										<label class="form-check-label" for="menu-item-target">Openen in nieuw
											tabblad?</label>
									</div>
									<br><br>
									<button type="submit" class="btn btn-primary">Toevoegen aan menu</button>
								</form>
							</div>
						</div>


						<div class="card shadow mb-4">
							<!-- Card Header - Accordion -->
							<a href="#add-custom-menu-item" class="d-block card-header py-3 collapsed"
							   data-toggle="collapse" role="button" aria-expanded="false"
							   aria-controls="add-custom-menu-item">
								<h6 class="m-0 font-weight-bold text-primary">Link aan het menu toeveogen</h6>
							</a>
							<!-- Card Content - Collapse -->
							<div class="collapse" id="add-custom-menu-item">
								<div class="card-body">
									<form action="<?= site_url('admin/menu/addMenuItem'); ?>" id="add-menu-items-form"
									      method="post">
										<div class="form-group row">
											<label for="menu-item-title" class="col-sm-4 col-form-label">Pagina
												titel</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="menu-item-title"
												       name="menu-item-title" required>
											</div>
										</div>
										<div class="form-group row">
											<label for="menu-item-slug" class="col-sm-4 col-form-label">Pagina
												url</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" name="menu-item-slug"
												       placeholder="http://google.com/" required>
											</div>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="checkbox" id="menu-item-target-2"
											       name="menu-item-target"
											       value="_blank">
											<label class="form-check-label" for="menu-item-target-2">Openen in nieuw
												tabblad?</label>
										</div>
										<br>
										<br>
										<button type="submit" class="btn btn-primary">Toevoegen aan menu</button>
									</form>
								</div>
							</div>
						</div>

					</div>

					<div class="col-12 col-md-8">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Menubeheer</h6>
							</div>
							<div class="card-body">
								<p>Het menu kan aangepast worden door de menu items te slepen.</p>
								<?php if ($menuItems) : ?>
										<ul id="sortable-list">
											<?php
											$order = array();
											foreach ($menuItems as $item) : ?>
												<div class="card mb-2 menuItem" title="<?= $item->id ?>">
													<!-- menu item Header - Accordion -->
													<a href="#menu-item-data-<?= $item->id ?>" style="cursor: move;"
													   class="d-block card-header py-3 collapsed"
													   data-toggle="collapse" role="button" aria-expanded="false"
													   aria-controls="menu-item-data-<?= $item->id ?>">
														<h6 class="m-0 font-weight-bold text-primary">
															<?= $item->menu_item_title ?>
															<?php if ($item->menu_item_url) : ?>
																<span class="text-secondary">(aangepaste link)</span>
															<?php endif; ?>
														</h6>
													</a>
													<!-- menu item Content - Collapse -->
													<div class="collapse" id="menu-item-data-<?= $item->id ?>">
														<div class="card-body">
															<form action="<?= site_url('admin/menu/editMenuItem'); ?>"
															      id="add-menu-items-form"
															      method="post">
																<input type="hidden" name="menu-item-id" value="<?= $item->id ?>">
																<div class="form-group row">
																	<label for="menu-item-title"
																	       class="col-sm-4 col-form-label">Pagina
																		titel</label>
																	<div class="col-sm-8">
																		<input type="text" class="form-control"
																		       id="menu-item-title"
																		       name="menu-item-title"
																		       value="<?= $item->menu_item_title ?>"
																		       required>
																	</div>
																</div>
																<?php if ($item->menu_item_url) : ?>
																	<div class="form-group row">
																		<label for="menu-item-url"
																		       class="col-sm-4 col-form-label">Pagina
																			url</label>
																		<div class="col-sm-8">
																			<input type="text" class="form-control"
																			       name="menu-item-url"
																			       value="<?= $item->menu_item_url ?>"
																			       required>
																		</div>
																	</div>
																<?php endif; ?>
																<div class="form-check form-check-inline">

																	<input class="form-check-input" type="checkbox"
																	       id="menu-item-target-<?= $item->id ?>"
																	       name="menu-item-target"
																	       value="_blank"
																		<?= ($item->menu_item_target == '_blank') ? 'checked' : null ?>
																	>
																	<label class="form-check-label"
																	       for="menu-item-target-<?= $item->id ?>">Openen in nieuw
																		tabblad?</label>
																</div>
																<br>
																<br>
																<a href="<?= site_url('admin/menu/delMenuItem/' . $item->id); ?>"
																   class="text-danger">Verwijderen</a>
																<button type="submit" class="btn btn-primary float-right">Aanpassen</button>
															</form>
														</div>
													</div>
												</div>
												<?php $order[] = $item->id; ?>
											<?php endforeach; ?>
										</ul>
										<input type="hidden" name="sort_order" id="sort_order"
										       value="<?php echo implode(',', $order); ?>"/>
								<?php else : ?>
									<b><i>Geen menu items gevonden...</i></b>
								<?php endif; ?>
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

<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
        integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
        crossorigin="anonymous"></script>
<script src="<?= asset_url() ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= asset_url() ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= asset_url() ?>js/sb-admin-2.min.js"></script>

<!-- Toastr-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    jQuery(document).ready(function () {
        var sortInput = jQuery('#sort_order');
        var list = jQuery('#sortable-list');

        var request = function () {
            jQuery.ajax({
                data: 'sort_order=' + sortInput[0].value,
                type: 'post',
                url: '/admin/menu/postMenuOrder',
                error: function (error) {
                    // console.log(error.responseText)
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
                success: function (data) {
                    toastr["success"]("Menu volgorde succesvol aangepast & opgeslagen! 😃", "Succes")

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
            });
        };

        /* worker function */
        var fnSubmit = function (save) {
            var sortOrder = [];
            list.children('div.menuItem').each(function () {
                sortOrder.push(jQuery(this).data('id'));
            });
            sortInput.val(sortOrder.join(','));
            if (save) {
                request();
            }
        };

        /* store values */
        list.children('div.menuItem').each(function () {
            var menuItem = jQuery(this);
            menuItem.data('id', menuItem.attr('title')).attr('title', '');
        });

        /* sortables */
        list.sortable({
            opacity: 0.7,
            update: function () {
                fnSubmit(true);
            }
        });
        list.disableSelection();

        /* ajax form submission */
        jQuery('#menu-items-form').bind('submit', function (e) {
            if (e) e.preventDefault();
            fnSubmit(true);
        });
    });
</script>

</body>
</html>
