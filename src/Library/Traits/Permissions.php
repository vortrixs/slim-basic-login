<?php

namespace SBL\Library\Traits;

use SBL\Library\SessionHelper;

trait Permissions
{
    /**
     * @var SessionHelper
     */
    protected $session;

    /**
     * @param array $args
     *
     * @return boolean
     */
    protected function isOwner(array $args)
    {
        if (false === $this->session->exists('sbl.user.current')) {
            return false;
        }

        $user = unserialize(base64_decode($this->session->get('sbl.user.current')));

        return $user['username'] === $args['username'];
    }
}
