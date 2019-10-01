<div class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title">Register</h4>
							<?= form_open( 'auth/register', array(
								'class'      => 'my-login-validation',
								'novalidate' => ''
							) ); ?>
                            <div class="form-group">
                                <label for="name">Username</label>
								<?= form_input( $username ); ?>
                                <small style="color: red"><?= form_error( 'username' ); ?></small>
                                <div class="invalid-feedback">
                                    What's your name?
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">E-Mail Address</label>
								<?= form_input( $email ); ?>
								<small style="color: red"><?= form_error( 'email' ); ?></small>
                                <div class="invalid-feedback">
                                    Your email is invalid
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
								<?= form_password( $password ); ?>
                                <small style="color: red"><?= form_error( 'password' ); ?></small>
                                <div class="invalid-feedback">
                                    Password is required
                                </div>
                            </div>

                            <div class="form-group m-0">
								<?= form_submit( 'register', 'Register', 'class="btn btn-primary btn-block"' ); ?>
                            </div>
                            <div class="mt-4 text-center">
                                Already have an account? <a href="login">Login</a>
                            </div>
							<?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
