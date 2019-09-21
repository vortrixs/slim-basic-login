<?php
/**
 * * @var array<string,int|string|bool> $user
 */
?>

<?php if (null === $user) : ?>
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
<?php else : ?>
    <?php if (true === is_array($user)) : ?>
        <span>You are logged in as: <?php echo $user['username']; ?></span>
    <?php endif; ?>
    <div id="logout">
        <form action="/logout" method="post"><button type="submit">Logout</button></form>
    </div>
<?php endif; ?>