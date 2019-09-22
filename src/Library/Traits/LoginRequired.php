<?php

namespace SBL\Library\Traits;

use SBL\Library\SessionHelper;

trait LoginRequired
{
    /**
     * @var SessionHelper
     */
    protected $session;

    /**
     * @return boolean
     */
    protected function isLoggedIn()
    {
        if (false === $this->session->exists('sbl.user.current')) {
            return false;
        }

        $data = unserialize(base64_decode($this->session->get('sbl.user.current')));

        if (false === is_int($data['id'])) {
            return false;
        }

        return true;
    }
}
