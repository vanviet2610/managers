<?php
$WEB_ROOT = "http://" . $_SERVER['HTTP_HOST'] . "/manageruser/";
define("_WEB_ROOT", $WEB_ROOT);
session_start();

require_once 'configs/route.php';
require_once 'configs/database.php';
require_once 'configs/session.php';

require_once 'app/App.php';

require_once 'core/Connection.php';
require_once 'core/QueryBuilder.php';
require_once 'core/Database.php';
require_once 'core/Model.php';
require_once 'core/Request.php';
require_once 'core/Response.php';
require_once 'core/Session.php';
require_once 'core/Controller.php';
$app = new App();




