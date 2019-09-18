<?php

namespace SBL\Library;

class SessionHelper
{
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key, $default = null)
    {
        if (false === $this->exists($key)) {
            return $default;
        }

        return $_SESSION[$key] ?: $default;
    }

    public function delete($key)
    {
        if ($this->exists($key)) {
            unset($_SESSION[$key]);
        }
    }

    public function exists($key)
    {
        return array_key_exists($key, $_SESSION);
    }

    public function flash($key)
    {
        if (false === $this->exists($key)) {
            return null;
        }

        $msg = $this->get($key);

        $this->delete($key);

        return $msg;
    }
}
