<?php

namespace App;

session_start();

require_once 'app' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
require_once dirname(__DIR__, 2) . '/vendor/autoload.php';
core\Route::start();
