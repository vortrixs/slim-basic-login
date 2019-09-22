<?php
/**
 * @var array<string,int|string|bool> $user
 * @var SBL\Model\UserModel[]         $users
 */
?>

<section class="col">
    <table id="user-list" class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">User</th>
                <th scope="col">Change password</th>
                <?php if (true === $user['isAdmin']) : ?>
                    <th scope="col">Delete user</th>
                    <th scope="col">Admin access</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $listUser) : ?>
                <?php $data = $listUser->getData(); ?>

                <div
                        class="modal fade"
                        id="deleteUserModal-<?php echo $data['id']; ?>"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="deleteUserModalLabel-<?php echo $data['id']; ?>"
                        aria-hidden="true"
                >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteUserModalLabel-<?php echo $data['id']; ?>">
                                    Delete user
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure that you want to delete the user <?php echo $data['username']; ?>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <form action="/user/<?php echo $data['username']; ?>/delete" method="post" class="m-0">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <tr>
                    <td><?php echo $data['username']; ?></td>

                    <?php if (true === $user['isAdmin'] || $data['username'] === $user['username']) : ?>
                        <td>
                            <a href="/user/<?php echo $data['username']; ?>/changepassword" class="btn btn-primary">
                                Change
                            </a>
                        </td>
                    <?php endif; ?>

                    <?php if (true === $user['isAdmin'] && $data['username'] !== $user['username']) : ?>
                        <td>
                            <button
                                    type="button"
                                    class="btn btn-danger"
                                    data-toggle="modal"
                                    data-target="#deleteUserModal-<?php echo $data['id']; ?>"
                            >
                                Delete
                            </button>
                        </td>
                        <td>
                            <form action="/user/<?php echo $data['username']; ?>/changeaccess" method="post">
                                <?php if (true === $data['isAdmin']) : ?>
                                    <input type="hidden" name="access" value="0">
                                    <button type="submit" class="btn btn-danger">Remove admin access</button>
                                <?php else : ?>
                                    <input type="hidden" name="access" value="1">
                                    <button type="submit" class="btn btn-primary">Grant admin access</button>
                                <?php endif; ?>
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
