<?php
/**
 * * @var array<string,int|string|bool> $user
 */
?>

<div id="logout" class="col mt-2">
    <span>You are logged in as: <?php echo $user['username']; ?></span>
    <form action="/logout" method="post" class="float-right mb-1">
        <button type="submit" class="btn btn-primary">Logout</button>
    </form>
</div>