<?php

namespace SBL\Library;

class SessionHelper
{
    /**
     * @param string|integer $key
     * @param mixed          $value
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param string|integer $key
     * @param mixed          $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (false === $this->exists($key)) {
            return $default;
        }

        return $_SESSION[$key] ?: $default;
    }

    /**
     * @param string|integer $key
     */
    public function delete($key)
    {
        if ($this->exists($key)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * @param string|integer $key
     *
     * @return boolean
     */
    public function exists($key) : bool
    {
        return array_key_exists($key, $_SESSION);
    }

    /**
     * @param string|integer $key
     *
     * @return mixed|null
     */
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
