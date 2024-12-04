<?php
session_start();
require '../vendor/autoload.php';


use FastRoute\Dispatcher;
use FastRoute\RouteCollector;

$container = [
    'App\Controllers\HomeController' => function () {
        return new \App\Controllers\HomeController(new \App\Models\PostModel());
    },
    'App\Controllers\Page404' => function () {
        return new \App\Controllers\Page404(new \App\lib\SessionManager());
    },
    'App\Controllers\LoginController' => function () {
        return new \App\Controllers\LoginController(new \App\lib\SessionManager, new \App\Services\UserService(new \App\Models\UserModel()));
    },
    'App\Controllers\CommentController' => function () {
        return new \App\Controllers\CommentController(new \App\lib\SessionManager(), new \App\Services\CommentService(new \App\Models\CommentModel()));
    },
    'App\Controllers\PostController' => function () {
        return new \App\Controllers\PostController(new \App\Services\CommentService(new \App\Models\CommentModel()), new \App\Services\PostService(new \App\Models\PostModel()), new \App\lib\SessionManager());
    },
    'App\Controllers\SignUpController' => function () {
        return new \App\Controllers\SignUpController(new \App\lib\SessionManager(), new \App\Services\RegisterUserService(new \App\Models\UserModel()));
    },
];

// Configure le routeur FastRoute
$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    require '../src/routes/web.php';
});


// Obtenir la méthode HTTP et l'URI
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Enlève la query string (?foo=bar) et décode l'URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = filter_var($uri, FILTER_SANITIZE_URL);

// Dispatcher la requête
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        $controller = new \App\Controllers\Page404(new \App\lib\SessionManager());
        $controller->show404();
        break;
    case Dispatcher::METHOD_NOT_ALLOWED:
        echo "405 - Méthode non autorisée";
        break;
    case Dispatcher::FOUND:
        [$controllerName, $method] = $routeInfo[1]; // Contrôleur à appeler
        $params = $routeInfo[2]; // Variables de la route


        if (isset($container[$controllerName])) {
            $controller = $container[$controllerName]();
            $table = [$controller, $method];

            if (is_callable($table)) {
                // Charger et instancier la classe du contrôleur
                CallControllerAndMethod($table, $params);
            }
            break;
        }
}

function CallControllerAndMethod($table, $params)
{
    return call_user_func_array($table, $params);
}
