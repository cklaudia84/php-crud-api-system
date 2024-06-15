<?php
require_once 'vendor/autoload.php';
echo 'crud api';

App\ProductController::main();   // /Product
App\ProductController::create(); // /Product/create
App\ProductController::get(123); // /Product/get/123