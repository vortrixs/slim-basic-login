<form id="login-form" name="login-form" action="/login" method="post">
    <div class="form-group">
        <label for="login-form-username">Username</label>
        <input id="login-form-username" class="form-control" type="text" name="username">
    </div>

    <div class="form-group">
        <label for="login-form-password">Password</label>
        <input id="login-form-password" class="form-control" type="password" name="password">
    </div>

    <div class="btn-group" role="group">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="/signup" class="btn btn-secondary">Sign up</a>
    </div>
</form>
