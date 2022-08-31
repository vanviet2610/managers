<?php
class Controller
{
    public function model($model)
    {
        if (file_exists('./app/models/' . $model . '.php')) {
            require_once './app/models/' . $model . '.php';
            if (class_exists($model)) {
                return $model = new $model();
            }
        }
        return false;
    }

    public function renderViews($view, $data = [])
    {
        if (!empty($data)) {
            extract($data);
        }
        if (file_exists("./app/views/" . $view . ".php")) {
            require_once "./app/views/" . $view . ".php";
        }
    }
}
