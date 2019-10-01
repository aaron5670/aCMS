<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin') ?>">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<div class="sidebar-brand-text mx-3"><sup>a</sup>CMS</div>
	</a>

	<hr class="sidebar-divider my-0">

	<li class="nav-item active">
		<a class="nav-link" href="<?= base_url('admin') ?>">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span></a>
	</li>

	<hr class="sidebar-divider">

	<div class="sidebar-heading">
		Website beheer
	</div>

	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
		   aria-expanded="true" aria-controls="collapsePages">
			<i class="fas fa-fw fa-folder"></i>
			<span>Pagina's</span>
		</a>
		<div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="<?= site_url('/admin/pages') ?>">Alle pagina's</a>
				<a class="collapse-item" href="<?= site_url('/admin/new-page') ?>">Nieuwe pagina</a>
			</div>
		</div>
	</li>

	<hr class="sidebar-divider">

	<div class="sidebar-heading">
		<sup>a</sup>CMS Beheer
	</div>

	<li class="nav-item">
		<a class="nav-link" href="<?= site_url('admin/users'); ?>">
			<i class="fas fa-users"></i>
			<span>Gebruikers</span>
		</a>
	</li>

	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTemplates"
		   aria-expanded="true" aria-controls="collapseTemplates">
			<i class="fas fa-palette"></i>
			<span>Templates</span>
		</a>
		<div id="collapseTemplates" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="<?= site_url('/admin/templates') ?>">Alle templates</a>
				<a class="collapse-item" href="<?= site_url('/admin/new-template') ?>">Nieuw template</a>
			</div>
		</div>
	</li>

	<li class="nav-item">
		<a class="nav-link" href="<?= site_url('admin/settings'); ?>">
			<i class="fas fa-cogs"></i>
			<span>Website instellingen</span>
		</a>
	</li>

	<hr class="sidebar-divider d-none d-md-block">

	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>
</ul>
