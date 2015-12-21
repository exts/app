<?php
/**
 * -------------------------------
 * | VENDOR LIBRARIES
 * -------------------------------
 */

use G4MR\Configs\Config;
use G4MR\Configs\Loader\YamlLoader;

/**
 * -------------------------------
 * | LOCAL LIBRARIES
 * -------------------------------
 */

use Framework\Render\Twig;
use Framework\Render\View;

/**
 * -------------------------------
 * | AUTOLOAD/DIRECTORY DEFINTIONS
 * -------------------------------
 */

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/paths.php';

/**
 * -------------------------------
 * | DEPENDENCY INJECTOR
 * -------------------------------
 */

$injector = new Auryn\Injector();

/**
 * -------------------------------
 * | SETUP CONFIG
 * -------------------------------
 */

$injector->share(YamlLoader::class);
$injector->define(YamlLoader::class, [
    ':directory' => PATH['CONFIG']
]);

$injector->define(Config::class, [
    'loader' => YamlLoader::class
]);

/** @var Config $config */
$config = $injector->make(Config::class);

/**
 * -------------------------------
 * | SETUP TWIG
 * -------------------------------
 */

/** @var \G4MR\Configs\Item $twig_options */
$twig_options = $config->getItem('twig');

$injector->share(Twig_Loader_Filesystem::class);
$injector->define(Twig_Loader_Filesystem::class, [
    ':paths' => PATH['TEMPLATE']
]);

$injector->share(Twig_Environment::class);
$injector->define(Twig_Environment::class, [
    'loader' => Twig_Loader_Filesystem::class,
    ':options' => [
        'autoescape' => $twig_options->get('autoescape', false),
        'strict_variables' => $twig_options->get('strict_variables', false),
    ]
]);

/**
 * -------------------------------
 * | SETUP RENDERER & VIEW
 * -------------------------------
 */

$injector->share(Twig::class);
$injector->define(Twig::class, [
    'renderer' => Twig_Environment::class
]);

$injector->share(View::class);
$injector->define(View::class, [
    'renderer' => Twig::class
]);

/**
 * -------------------------------
 * | SETUP SLIM
 * -------------------------------
 */

$container  = new Slim\Container();
$app        = new \Slim\App($container);

/**
 * -------------------------------
 * | SETUP CONTROLLERS & ROUTES
 * -------------------------------
 */

require_once PATH['BASE'] . '/actions.php';

/**
 * -------------------------------
 * | RETURN SLIM OBJECT
 * -------------------------------
 */

return $app;