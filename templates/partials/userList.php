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
                    <td><a href="/user/<?php echo $data['username']; ?>/changepassword">Change</a></td>
                <?php endif; ?>

                <?php if (true === $user['isAdmin'] && $data['username'] !== $user['username']) : ?>
                    <td>Delete</td>
                    <td>Make/remove admin</td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>