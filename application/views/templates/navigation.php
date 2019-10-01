<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="<?= site_url(); ?>">{site_title}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="<?= site_url()?>">Home</a>
                </li>
				<?php
				if ( ! $this->ion_auth->logged_in() ) :
					?>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="<?= site_url( 'auth/login' ); ?>">Login</a>
                    </li>
				<?php
				else :
					?>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="<?= site_url( 'home/keys' ); ?>">Keys</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="<?= site_url( 'auth' ); ?>">Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="<?= site_url( 'auth/logout' ); ?>">Logout</a>
                    </li>
				<?php
				endif;
				?>
            </ul>
        </div>
    </div>
</nav>