<div class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center align-items-center h-100">
                <div class="card-wrapper">
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo lang('reset_password_heading');?></h4>
                            <div id="infoMessage" style="color: red"><?= $message; ?></div>
							<?= form_open( 'auth/reset_password/' . $code, array(
								'class'      => 'my-login-validation',
								'novalidate' => ''
							) ); ?>
                            <div class="form-group">
                                <label for="new-password"><?= sprintf( lang( 'reset_password_new_password_label' ), $min_password_length ); ?></label>
	                            <?= form_input( $new_password ); ?>
                                <div class="invalid-feedback">
                                    Password is required
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="new-password"><?= lang( 'reset_password_new_password_confirm_label', 'new_password_confirm' ); ?></label>
	                            <?= form_input( $new_password_confirm ); ?>
                                <div class="invalid-feedback">
                                    Password is required
                                </div>
                                <div class="form-text text-muted">
                                    Make sure your password is strong and easy to remember
                                </div>
                            </div>

	                        <?php echo form_input($user_id);?>
	                        <?php echo form_hidden($csrf); ?>

                            <div class="form-group m-0">
	                            <?= form_submit( 'submit', lang( 'reset_password_submit_btn' ), 'class="btn btn-primary btn-block"' ); ?>
                            </div>
							<?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
