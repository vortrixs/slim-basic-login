<?php
/**
 * @var SBL\Library\SessionHelper $session
 * @var array<string>|null        $user
 */

extract($this->data);
?>
<html lang="en">
    <head>
        <title>Home</title>
    </head>
    <body>
    <section>
        <?php if (true === $session->exists('sbl.user.created')) : ?>
            <span><?php echo $session->flash('sbl.user.created'); ?></span>
        <?php endif; ?>
        <?php if (true === $session->exists('sbl.user.login.msg')) : ?>
            <span><?php echo $session->flash('sbl.user.login.msg'); ?></span>
        <?php endif; ?>

        <?php
        include_once __DIR__ . '/partials/loginForm.php';

        if (null !== $user) {
            include_once __DIR__ . '/partials/userList.php';
        }
        ?>
    </section>
    </body>
</html>