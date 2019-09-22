<?php
/**
 * @var array $errors
 * @var array $old
 */
extract($this->data);
?>
<html lang="en">
    <head>
        <title>Sign up</title>
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
                    <form id="signup-form" action="/signup" method="post">
                        <div class="form-group">
                            <label for="signup-form-username">Username</label>

                            <input
                                    id="signup-form-username"
                                    class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>"
                                    type="text"
                                    name="username"
                                    value="<?php echo empty($errors['username']) && isset($old) ? $old['username'] : ''; ?>"
                            >

                            <?php if (isset($errors['username'])) : ?>
                                <span class="invalid-feedback"><?php echo $errors['username']; ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="signup-form-password">Password</label>
                            <input
                                    id="signup-form-password"
                                    class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>"
                                    type="password"
                                    name="password"
                            >
                            <?php if (isset($errors['password'])) : ?>
                                <span class="invalid-feedback"><?php echo $errors['password']; ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="signup-form-password-repeat">Repeat password</label>
                            <input
                                    id="signup-form-password-repeat"
                                    class="form-control <?php echo isset($errors['password2']) || isset($errors['password']) ? 'is-invalid' : ''; ?>"
                                    type="password"
                                    name="password2"
                            >
                            <?php if (isset($errors['password2'])) : ?>
                                <span class="invalid-feedback"><?php echo $errors['password2']; ?></span>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-primary">Create user</button>
                        <a href="/" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>
