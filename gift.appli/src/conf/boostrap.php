<?php 
declare(strict_types=1);

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$app = AppFactory::create();


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$twig = Twig::create(__DIR__ . '/../app/views', ['cache' => false,]);
$twig->getEnvironment()->addGlobal('css', 'assets/css');
$twig->getEnvironment()->addGlobal('js', 'assets/js');
$twig->getEnvironment()->addGlobal('img', 'assets/img');
$twig->getEnvironment()->addGlobal('session', $_SESSION);

$app->add(TwigMiddleware::create($app, $twig));

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);


$app=(require_once __DIR__ . '/routes.php')($app);


return $app;
