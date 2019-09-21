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
    </head>
    <body>
        <?php if ($session->exists('sbl.user.update.failed')) : ?>
            <span><?php echo $session->get('sbl.user.update.failed'); ?></span>
        <?php endif; ?>

        <section>
            <form id="change-password-form" action="/user/<?php echo $username; ?>/changepassword" method="post">
                <label for="change-password-pw">Password</label>
                <input id="change-password-pw" type="password" name="password">

                <label for="change-password-pw-repeat">Repeat password</label>
                <input id="change-password-pw-repeat" type="password" name="password2">

                <button type="submit">Change password</button>
            </form>
        </section>
    </body>
</html>
