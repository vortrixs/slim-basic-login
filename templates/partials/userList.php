<?php
/**
 * @var array<string>|null    $user
 * @var SBL\Model\UserModel[] $users
 */

if (false === array_key_exists('users', get_defined_vars())) {
    throw new RuntimeException('$users needs to be initialized as a collection of SBL\Model\UserModel instances');
}

var_dump($user);

?>

<table>
    <tr>
        <th>Username</th>
        <th>Change password</th>
        <?php if (true === $user['isAdmin']) : ?>
            <th>Delete user</th>
        <?php endif; ?>
    </tr>
    <?php foreach ($users as $listUser) : ?>
        <?php $data = $listUser->getData(); ?>
        <tr>
            <td><?php echo $data['username']; ?></td>
            <td><a href="/user/<?php echo $data['username']; ?>/changepassword">Change</a></td>
            <?php if (true === $user['isAdmin']) : ?>
                <td><a href="/user/<?php echo $data['username']; ?>/delete">Delete</a></td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
</table>