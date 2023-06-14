<?php

namespace App\core;

define('CONTROLLERS_NAMESPACE', 'App\\controllers\\');
class Route
{
  public static function start()
  {
    $controllerClassname = 'home';
    $actionName = 'index';
    $payload = [];

    $routes = explode('/', $_SERVER["REQUEST_URI"]);

    if (!empty($routes[1])) {
      $controllerClassname = $routes[1];
    }
    if (!empty($routes[2])) {
      $actionName = $routes[2];
    }

    if (!empty($routes[3])) {
      $payload = array_slice($routes, 3);
    }

    $controllerFile = ucfirst(strtolower($controllerClassname)) . '.php';
    $controller_path = CONTROLLER . $controllerFile;
    if (file_exists($controller_path)) {
      include_once $controller_path;
    } else {
      Route::Error();
    }
    $controllerName = CONTROLLERS_NAMESPACE . ucfirst($controllerClassname);
    $controller = new $controllerName();
    $method = $actionName;
    if (method_exists($controller, $method)) {
      $controller->$method($payload);
    } else {
      Route::Error();
    }
  }
  public static function Error()
  {
    header('HTTP/1 404 Not Found');
    header('Status: 404 Not Found');
    header('Location:/error');
  }
}
