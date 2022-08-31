<?php
class Respone
{
    public function redirect($uri = "", $code = 200)
    {
        $url =  _WEB_ROOT . $uri;
        if (!empty($uri)) {
            header("location:" . $url);
            exit;
        }
    }
}
