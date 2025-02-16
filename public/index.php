<?php

use App\Player\Infrastructure\WebController\PlayerController;
use App\Player\Infrastructure\WebController\PlayerCreatorController;
use App\Player\Infrastructure\WebController\PlayerUpdaterController;
use App\Team\Infrastructure\WebController\TeamController;
use App\Team\Infrastructure\WebController\TeamCreatorController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

require_once __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../config/services.php';

$dc = [];

$routes = [
    'team' => (new Route(TeamController::PATH, ['_controller' => TeamController::class]))->setMethods(['GET']),
    'team_creator' => (new Route(TeamCreatorController::PATH, ['_controller' => TeamCreatorController::class]))->setMethods(['GET', 'POST']),
    'player' => (new Route(PlayerController::PATH, ['_controller' => PlayerController::class]))->setMethods(['GET']),
    'player_creator' => (new Route(PlayerCreatorController::PATH, ['_controller' => PlayerCreatorController::class]))->setMethods(['GET', 'POST']),
    'player_updater' => (new Route(PlayerUpdaterController::PATH, ['_controller' => PlayerUpdaterController::class]))->setMethods(['GET', 'POST']),
];

$rc = new RouteCollection();

foreach ($routes as $key => $route) {
    $rc->add($key, $route);
}

$context = new RequestContext();

$matcher = new UrlMatcher($rc, $context);
$request = Request::createFromGlobals();
$context->fromRequest($request);

try {
    $attributes = $matcher->match($context->getPathInfo());
    $ctrlName = $attributes['_controller'];

    // Obtener el controlador desde el contenedor en lugar de instanciarlo manualmente
    $ctrl = $container->get($ctrlName);

    $request->attributes->add($attributes);

    if (isset($attributes['method'])) {
        $response = $ctrl->{$attributes['method']}($request);
    } else {
        $response = $ctrl($request);
    }
} catch (ResourceNotFoundException) {
    $response = new Response('Not found!', Response::HTTP_NOT_FOUND);
} catch (Exception $e) {
    $response = new Response(sprintf('An error occurred: %s', $e->getMessage()), Response::HTTP_INTERNAL_SERVER_ERROR);
}

$response->send();
