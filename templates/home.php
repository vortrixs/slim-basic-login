<?php
/**
 * @var SBL\Library\SessionHelper $session
 */

extract($this->data);
?>
<html lang="en">
    <head>
        <title>Home</title>
    </head>
    <body>
        <?php if (true === $session->exists('sbl.user.created')) : ?>
            <span><?php echo $session->flash('sbl.user.created'); ?></span>
        <?php endif; ?>
        <section>
            <div id="login">
                <form id="login-form" name="login-form" action="/login" method="post">
                    <label for="login-form-username">Username</label>
                    <input id="login-form-username" type="text" name="username">

                    <label for="login-form-password">Password</label>
                    <input id="login-form-password" type="password" name="password">

                    <button type="submit">Login</button>
                </form>

                <a href="/signup">Sign up</a>
            </div>
        </section>
    </body>
</html>