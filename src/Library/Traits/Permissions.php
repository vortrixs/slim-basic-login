<?php

namespace SBL\Library\Traits;

use SBL\Library\SessionHelper;

trait Permissions
{
    /**
     * @var SessionHelper
     */
    protected $session;

    protected function isOwner(array $args)
    {
        $user = unserialize(base64_decode($this->session->get('sbl.user.current')));

        return $user['username'] === $args['username'];
    }
}
