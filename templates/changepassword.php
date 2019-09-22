<?php
/**
 * @var string                    $username
 * @var SBL\Library\SessionHelper $session
 */
extract($this->data);
?>
<html lang="en">
    <head>
        <title>Change password</title>
        <link
                rel="stylesheet"
                href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
                crossorigin="anonymous"
        >
    </head>
    <body>
        <section class="container h-75">
            <div class="row h-75 justify-content-center align-items-center">
                <div class="col-6">
                    <?php if ($session->exists('sbl.user.update.failed')) : ?>
                        <div class="alert alert-danger"><?php echo $session->flash('sbl.user.update.failed'); ?></div>
                    <?php endif; ?>

                    <form id="change-password-form" action="/user/<?php echo $username; ?>/changepassword" method="post">
                        <div class="form-group">
                            <label for="change-password-pw">Password</label>
                            <input id="change-password-pw" type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="change-password-pw-repeat">Repeat password</label>
                            <input id="change-password-pw-repeat" type="password" name="password2" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Change password</button>
                        <a href="/" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>
