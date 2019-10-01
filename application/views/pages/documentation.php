<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2>Documentation about this REST API</h2>
                <p class="lead">Example code / how-to explained below</p>
                <ul>
                    <li>CURL API get method</li>
                    <li>CURL API post method</li>
                    <strong>
                        <li>Coming soon: CURL API put method</li>
                        <li>Coming soon: CURL API update method</li>
                        <li>Coming soon: CURL API delete method</li>
                        <li>Coming soon: How to adjust the API settings</li>
                    </strong>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="services" class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2>Example #1: CURL get method</h2>
                <p class="lead">View live example <a href="<?= site_url('/product/get/1') ?>" target="_blank">here</a>.</p>
				<?php
				$code = file_get_contents( asset_url() . '/text/curl_get.txt' );
				highlight_string( $code );
				?>
            </div>
        </div>
    </div>
</section>

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2>Example #2: CURL post method</h2>
                <p class="lead">View live example <a href="<?= site_url('/product/post') ?>" target="_blank">here</a>.</p>
	            <?php
	            $code = file_get_contents( asset_url() . '/text/curl_post.txt' );
	            highlight_string( $code );
	            ?>
            </div>
        </div>
    </div>
</section>

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2>Example #3: CURL put method</h2>
                <p class="lead">Coming soon!</p>
            </div>
        </div>
    </div>
</section>

<section id="services" class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2>Example #4: CURL update method</h2>
                <p class="lead">Coming soon!</p>
            </div>
        </div>
    </div>
</section>

<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2>Example #5: CURL delete method</h2>
                <p class="lead">Coming soon!</p>
            </div>
        </div>
    </div>
</section>
