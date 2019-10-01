<div class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center align-items-center h-100">
                <div class="card-wrapper">
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title"><?= lang( 'forgot_password_heading' ); ?></h4>
                            <div id="infoMessage" style="color: red"><?= $message; ?></div>
							<?= form_open( 'auth/forgot_password', array(
								'class'      => 'my-login-validation',
								'novalidate' => ''
							) ); ?>
                            <div class="form-group">
                                <label for="identity"><?= ( ( $type == 'email' ) ? sprintf( lang( 'forgot_password_email_label' ), $identity_label ) : sprintf( lang( 'forgot_password_identity_label' ), $identity_label ) ); ?></label>
	                            <?= form_input( $identity ); ?>
                                <div class="invalid-feedback">
                                    Email is invalid
                                </div>
                                <div class="form-text text-muted">
                                    By clicking "Reset Password" we will send a password reset link
                                </div>
                            </div>

                            <div class="form-group m-0">
								<?= form_submit( 'submit', lang( 'forgot_password_submit_btn' ), 'class="btn btn-primary btn-block"' ); ?>
                            </div>
							<?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

