<?php 
require_once "../vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;
use Zend\Diactoros\Response\RedirectResponse;

$dotenv = Dotenv\Dotenv::createMutable(__DIR__ . '/..');
$dotenv->load();

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => getenv('DATABASE_DRIVER'),
    'host'      => getenv('DATABASE_HOST'),
    'database'  => getenv('DATABASE_NAME'),
    'username'  => getenv('DATABASE_USER'),
    'password'  => getenv('DATABASE_PASS'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();
$map->get('index', '/newadventures/', [
    'controller' => 'app\controllers\DashboardController',
    'action' => 'dashboardAction'
]);

$matcher = $routerContainer->getMatcher();

$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$route = $matcher->match($request);
if(!$route){
    echo 'No route';
} else {
    $handlerData = $route->handler;
    $controllerName = $handlerData['controller'];
    $actionName = $handlerData['action'];

    $controller = new $controllerName;
    $response = $controller->$actionName($request);

    foreach ($response->getHeaders() as $name => $values) {
        foreach ($values as $value) {
            header(sprintf('%s: %s', $name, $value), false);
        }
    }

    http_response_code($response->getStatusCode());

    echo $response->getBody();
}

