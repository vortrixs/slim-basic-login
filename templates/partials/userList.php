<?php
/**
 * @var array<string,int|string|bool> $user
 * @var SBL\Model\UserModel[]         $users
 */
?>

<table id="user-list">
    <thead>
        <tr>
            <th>User</th>
            <th>Change password</th>
            <?php if (true === $user['isAdmin']) : ?>
                <th>Delete user</th>
                <th>Admin access</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $listUser) : ?>
            <?php $data = $listUser->getData(); ?>
            <tr>
                <td><?php echo $data['username']; ?></td>

                <?php if (true === $user['isAdmin'] || $data['username'] === $user['username']) : ?>
                    <td><a href="/user/<?php echo $data['username']; ?>/changepassword"><button>Change</button></a></td>
                <?php endif; ?>

                <?php if (true === $user['isAdmin'] && $data['username'] !== $user['username']) : ?>
                    <td>
                        <form action="/user/<?php echo $data['username']; ?>/delete" method="post">
                            <button type="submit">Delete</button>
                        </form>
                    </td>

                    <td>
                        <form action="/user/<?php echo $data['username']; ?>/changeaccess" method="post">
                            <?php if (true === $data['isAdmin']) : ?>
                                <input type="hidden" name="access" value="0">
                                <button type="submit">Remove admin access</button>
                            <?php else : ?>
                                <input type="hidden" name="access" value="1">
                                <button type="submit">Grant admin access</button>
                            <?php endif; ?>
                        </form>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>