<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin') ?>">
		<div class="sidebar-brand-icon">
			<img src="<?= asset_url() ?>/img/logo-white.png" width="50" alt="">
		</div>
		<div class="sidebar-brand-text mx-3"><sup>a</sup>CMS</div>
	</a>

	<hr class="sidebar-divider my-0">

	<li class="nav-item <?= active_menu(array('/admin')); ?>">
		<a class="nav-link" href="<?= base_url('admin') ?>">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span></a>
	</li>

	<hr class="sidebar-divider">

	<div class="sidebar-heading">
		Website beheer
	</div>

	<?php
	$urlArray = array(
		'/admin/pages',
		'/admin/new-page',
	)
	?>
	<li class="nav-item <?= active_menu(array('/admin/pages', '/admin/pages/new-page', '/admin/pages?message=success')); ?>">
		<a class="nav-link <?= active_submenu(array('/admin/pages', '/admin/pages/new-page', '/admin/pages?message=success'), 'collapsed') ?>" href="#"
		   data-toggle="collapse" data-target="#collapsePages"
		   aria-expanded="true" aria-controls="collapsePages">
			<i class="fas fa-fw fa-folder"></i>
			<span>Pagina's</span>
		</a>
		<div id="collapsePages"
		     class="collapse <?= active_submenu(array('/admin/pages', '/admin/pages/new-page', '/admin/pages?message=success'), 'show') ?>"
		     aria-labelledby="headingPages" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item <?= active_menu(array('/admin/pages', '/admin/pages?message=success')); ?>"
				   href="<?= site_url('/admin/pages') ?>">Alle pagina's</a>
				<a class="collapse-item <?= active_menu(array('/admin/pages/new-page')); ?>"
				   href="<?= site_url('/admin/pages/new-page') ?>">Nieuwe pagina</a>
			</div>
		</div>
	</li>

	<li class="nav-item <?= active_menu(array('/admin/menu')); ?>">
		<a class="nav-link" href="<?= site_url('admin/menu'); ?>">
			<i class="fas fa-bars"></i>
			<span>Menu</span>
		</a>
	</li>

	<li class="nav-item <?= active_menu(array('/admin/settings')); ?>">
		<a class="nav-link" href="<?= site_url('admin/settings'); ?>">
			<i class="fas fa-cog"></i>
			<span>Website instellingen</span>
		</a>
	</li>

	<hr class="sidebar-divider">

	<div class="sidebar-heading">
		<sup>a</sup>CMS Beheer
	</div>

	<li class="nav-item <?= active_menu(array('/admin/users')); ?>">
		<a class="nav-link" href="<?= site_url('admin/users'); ?>">
			<i class="fas fa-users"></i>
			<span>Gebruikers</span>
		</a>
	</li>

	<li class="nav-item <?= active_menu(array('/admin/templates', '/admin/templates/new-template')); ?>">
		<a class="nav-link <?= active_submenu(array('/admin/templates', '/admin/templates/new-template'), 'collapsed') ?>" href="#"
		   data-toggle="collapse" data-target="#collapseTemplates"
		   aria-expanded="false" aria-controls="collapseTemplates">
			<i class="fas fa-palette"></i>
			<span>Templates</span>
		</a>
		<div id="collapseTemplates"
		     class="collapse <?= active_submenu(array('/admin/templates', '/admin/templates/new-template'), 'show') ?>"
		     aria-labelledby="headingPages" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item <?= active_menu(array('/admin/templates')); ?>"
				   href="<?= site_url('/admin/templates') ?>">Alle templates</a>
				<a class="collapse-item <?= active_menu(array('/admin/templates/new-template')); ?>"
				   href="<?= site_url('/admin/templates/new-template') ?>">Nieuw template</a>
			</div>
		</div>
	</li>

	<li class="nav-item <?= active_menu(array('/admin/settings/cms')); ?>">
		<a class="nav-link" href="<?= site_url('admin/settings/cms'); ?>">
			<i class="fas fa-cogs"></i>
			<span>aCMS instellingen</span>
		</a>
	</li>

	<li class="nav-item <?= active_menu(array('/admin/logs')); ?>">
		<a class="nav-link" href="<?= site_url('admin/logs'); ?>">
			<i class="fas fa-bug"></i>
			<span>Log viewer</span>
		</a>
	</li>

	<hr class="sidebar-divider d-none d-md-block">

	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>
</ul>
