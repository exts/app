<?php

/**
 * Create routes based off config data
 * @param \Slim\App $app
 * @param \Slim\Container $container
 * @param array $routes
 * @return \Slim\App
 */
function generateRouteData(Slim\App $app, Slim\Container $container, array $routes = []) : Slim\App
{
    foreach($routes as $route) {
        //defaults
        $name       = $route['name'] ?? false;
        $action     = $route['action'] ?? false;
        $method     = $route['method'] ?? 'any';
        $current    = $route['route'] ?? false;

        //if current action isn't set, go to the next item
        if(!$action) {
            continue;
        }

        //try getting class name/method
        $action = explode('.', $action, 2);

        $class_object = $action[0] ?? false;
        $class_method = $action[1] ?? false;

        if(!$class_object || !$class_method) {
            continue;
        }

        //check if class exists in container & if method exists
        $class = $container['controller.' . $class_object] ?? false;
        if(!$class || !method_exists($class, $class_method)) {
            continue;
        }

        $available_methods  = ['patch', 'delete', 'options', 'put', 'post', 'get', 'any'];
        $method             = !in_array(trim($method), $available_methods) ? 'any' : $method;

        //set route & name if applicable
        if($name !== false) {
            $app->$method($current, [$class, $class_method])->setName($name);
        } else {
            $app->$method($current, [$class, $class_method]);
        }
    }

    return $app;
}