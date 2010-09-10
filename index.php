<?php

error_reporting(E_ALL);
ini_set('display_errors', 0);

function shutdown() {
    $isError = false;
    if ($error = error_get_last()) {
        switch ($error['type']) {
            case E_ERROR:
            case E_CORE_ERROR:
            case E_COMPILE_ERROR:
            case E_USER_ERROR:
                $isError = true;
                break;
        }
    }

    if ($isError) {
        echo "Script execution halted ({$error['message']})";
    } else {
        echo "Script completed";
    }
}

register_shutdown_function('shutdown');

define('MONGOUI_ROOT', __DIR__ == '/' ? '' : __DIR__);

require_once 'core/Loader.php';
require_once 'core/functions.php';

$controller = MongoUI\Core\FrontController::getInstance();
$controller->init();
$controller->dispatch();

