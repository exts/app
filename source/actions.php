<?php
use G4MR\Configs\Config;

/** @var Config $config */
$config = $injector->make(Config::class);

/**
 * -------------------------------
 * | SETUP CONTROLLERS
 * -------------------------------
 */
$controllers = $config->get('controllers', []);
foreach($controllers as $controller => $class) {
    $container['controller.' . $controller] = $injector->make($class);
}

/**
 * -------------------------------
 * | SETUP ROUTES
 * -------------------------------
 */
$routes = $config->get('routes', []);
foreach($routes as $group => $_routes) {
    if($group !== 'default') {
        $app->group($group, function() use($_routes, $container) {
            $app = $this;
            $app = generateRouteData($app, $container, $_routes);
        });
    } else {
        $app = generateRouteData($app, $container, $_routes);
    }
}