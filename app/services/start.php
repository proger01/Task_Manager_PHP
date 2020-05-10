<?php

namespace app\services;
use FastRoute;
use DI\Container;
use DI\ContainerBuilder;
use app\controllers\MainController;
use League\Plates\Engine;
use Aura\SqlQuery\QueryFactory;
use PDO;

$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions([
    Engine::class => function() {
        return new Engine('../app/views');
    },
    QueryFactory::class => function() {
        return new QueryFactory('mysql');
    },
    PDO::class => function() {
        return new PDO('mysql:host=localhost; dbname=test', 'root', '');
    },
]);

$container = $containerBuilder->build();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', ['app\controllers\MainController', 'index']);
    $r->addRoute('GET', '/create', ['app\controllers\MainController', 'create']);
    $r->addRoute('POST', '/store', ['app\controllers\MainController', 'store']);
    $r->addRoute('GET', '/show/{id}', ['app\controllers\MainController', 'show']);
    $r->addRoute('GET', '/edit/{id}', ['app\controllers\MainController', 'edit']);
    $r->addRoute('POST', '/update/{id}', ['app\controllers\MainController', 'update']);
    $r->addRoute('GET', '/delete/{id}', ['app\controllers\MainController', 'delete']);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "404 Not Found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo "405 Method Not Allowed";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
       
        $container->call($handler, $vars);

        break;
}
