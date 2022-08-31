<?php
class Session
{
    public static function dataSession($key = "", $value = "")
    {
        global $configs;
        if (!empty($value)) {
            $_SESSION[$configs["session"]][$key] = $value;
            return true;
        } else {
            if (isset($_SESSION[$configs["session"]][$key])) {
                return $_SESSION[$configs["session"]][$key];
            }
            return false;
        }
    }

    public static function deleteSession($key = "")
    {
        global $configs;
        if (!empty($key)) {
            if (isset($_SESSION[$configs["session"]][$key])) {
                unset($_SESSION[$configs["session"]][$key]);
                return true;
            }
        } else {
            session_destroy($_SESSION);
            return true;
        }
    }

    static function flash($key = "", $value = "")
    {
        $flashSession =  self::dataSession($key, $value);
        if (empty($value)) {
            self::deleteSession($key);
            return $flashSession;
        }
        return true;
    }
}
