<?php

require_once 'app/config.php';
require_once 'vendor/autoload.php';

use System\Request as Req;

$controller = Req::getControllerName();
$action = Req::getAction();
$param = Req::getActionParamValue();

System\Api::serve($controller, $action, $param);

/*
App\ProductController::main();   // /product
App\ProductController::create(); // /product/create
App\ProductController::get(123); // /product/get/123
 */