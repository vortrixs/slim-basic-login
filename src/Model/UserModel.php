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
        $this->isLoggedIn = false;
        $this->isAdmin    = false;

        return $this;
    }

    public function getUser(string $username) : UserModel
    {
        $data = $this->crud->read('*', [['WHERE', 'username', '=', $username]], 1);

        $this->id       = $data['id'];
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->isAdmin  = $data['is_admin'];

        return $this;
    }

    public function getUserById(int $id) : UserModel
    {
        $data = $this->crud->read('*', [['WHERE', 'id', '=', $id]]);

        $this->id       = $data['id'];
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->isAdmin  = $data['is_admin'];

        return $this;
    }

    public function getData() : array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'password' => $this->password,
            'isAdmin' => $this->isAdmin,
        ];
    }
}
