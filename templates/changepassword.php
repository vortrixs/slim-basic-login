<?php
/**
 * @var string $username
 */
extract($this->data);
?>
<html lang="en">
    <head>
        <title>Change password</title>
    </head>
    <body>
        <section>
            <form id="change-password-form" action="/user/<?php echo $username; ?>/changepassword" method="post">
                <label for="change-password-pw">Password</label>
                <input id="change-password-pw" type="password" name="password">

                <label for="change-password-pw-repeat">Password repeat</label>
                <input id="change-password-pw-repeat" type="password" name="password2">

                <button type="submit">Change password</button>
            </form>
        </section>
    </body>
</html>
