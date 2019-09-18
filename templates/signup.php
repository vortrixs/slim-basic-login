<?php
/**
 * @var string username
 * @var string password
 * @var string password2
 */
extract($this->data);
?>
<html>
    <head>
        <title>Sign up</title>
    </head>
    <body>
        <form id="signup-form" action="/signup" method="post">
            <label for="signup-form-username">Username</label>
            <input id="signup-form-username" type="text" name="username">
            <?php if (isset($username)) : ?>
                <span><?php echo $username; ?></span>
            <?php endif; ?>

            <label for="signup-form-password">Password</label>
            <input id="signup-form-password" type="password" name="password">
            <?php if (isset($password)) : ?>
                <span><?php echo $password; ?></span>
            <?php endif; ?>

            <label for="signup-form-password-repeat">Repeat password</label>
            <input id="signup-form-password-repeat" type="password" name="password2">
            <?php if (isset($password2)) : ?>
                <span><?php echo $password2; ?></span>
            <?php endif; ?>

            <button type="submit">Create user</button>
        </form>
    </body>
</html>
