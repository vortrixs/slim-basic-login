<?php
/**
 * @var SBL\Library\SessionHelper $session
 * @var SBL\Model\UserModel       $user
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
        <?php if (true === $session->exists('sbl.user.login.msg')) : ?>
            <span><?php echo $session->flash('sbl.user.login.msg'); ?></span>
        <?php endif; ?>

        <?php if (null === $user) : ?>
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
        <?php else : ?>
            <?php if (true === is_array($user)) : ?>
                <span>You are logged in as: <?php echo $user['username']; ?></span>
            <?php endif; ?>
        <section>
            <form action="/logout" method="post"><button type="submit">Logout</button></form>
        </section>
        <?php endif; ?>
    </body>
</html>