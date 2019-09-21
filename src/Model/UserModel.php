<?php

namespace SBL\Model;

use SBL\Library\AbstractModel;

class UserModel extends AbstractModel
{
    private $id;
    private $isAdmin;
    private $username;
    private $password;

    public function createUser(string $username, string $password)
    {
        $isNew = ! (bool) $this->crud->read('id', [['WHERE', 'username', '=', $username]], 1);

        if (false === $isNew) {
            return false;
        }

        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

        $this->crud->create(
            ['username' => $username, 'password' => $passwordHashed]
        );

        $this->username   = $username;
        $this->password   = $passwordHashed;
        $this->isAdmin    = false;

        return $this;
    }

    public function getUser(string $username) : UserModel
    {
        $data = $this->crud->read(['*'], [['WHERE', 'username', '=', $username]], 1);

        if (false === $data) {
            return $this;
        }

        $this->id       = (int) $data['id'];
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->isAdmin  = (bool) $data['is_admin'];

        return $this;
    }

    public function getData() : array
    {
        return [
            'id'       => $this->id,
            'username' => $this->username,
            'password' => $this->password,
            'isAdmin'  => $this->isAdmin,
        ];
    }

    public function getAll() : \Generator
    {
        $data = $this->crud->read(['username']);

        foreach ($data as $row) {
            $clone = clone $this;

            yield $clone->getUser($row['username']);
        }
    }

    public function changePassword(string $newPassword) : int
    {
        return $this->crud->update(
            ['password' => password_hash($newPassword, PASSWORD_DEFAULT)],
            [['WHERE', 'username', '=', $this->username]]
        );
    }

    public function changeAdminAccess(int $access)
    {
        return $this->crud->update(['is_admin' => $access], [['WHERE', 'username', '=', $this->username]]);
    }
}
