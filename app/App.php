<?php
class App
{
    private $controller, $action, $param;
    public static $app = null;

    function __construct()
    {
        global $route;
        self::$app = $this;
        $this->controller = $route['controller-defaul'] . "Controller";
        $this->action = "index";
        $this->param  = [];
        $this->handleURL();
    }

    public function handleURL()
    {
        $urlArray =  array_values(array_filter(explode('/', $this->getURL())));
        if (!empty($urlArray[0])) {
            $this->controller = ucfirst($urlArray[0]) . "Controller";
            unset($urlArray[0]);
            if (file_exists("app/controllers/" . $this->controller . ".php")) {
                require_once "app/controllers/" . $this->controller . ".php";
                $this->controller = new $this->controller();
            } else {
                return   $this->loadError("404");
            }
        } else {
            require_once "app/controllers/" . $this->controller . ".php";
            $this->controller = new $this->controller();
        }
        if (!empty($urlArray[1])) {
            $this->action = $urlArray[1];
            unset($urlArray[1]);
            $this->param = array_values($urlArray);
            if (method_exists($this->controller, $this->action)) {
                call_user_func_array([$this->controller, $this->action], $this->param);
            } else {
                return $this->loadError(404);
            }
        } else {
            call_user_func_array([$this->controller, $this->action], $this->param);
        }
    }
    private function getURL()
    {
        if (!empty($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        } else {
            $url = "/";
        }
        return $url;
    }
    public function loadError($error = "404", $data = "")
    {
        require_once 'views/errors/' . $error . '.php';;
        die;
    }
}
