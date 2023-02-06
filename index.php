<?php

require 'application/lib/Dev.php';
require 'application/lib/helper.php';
require 'application/core/Router.php';

$router = new application\core\Router();
$router->bootstrap();
$router->run();
