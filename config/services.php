<?php

use App\Player\ApplicationService\PlayerByTeamSearcher;
use App\Player\ApplicationService\PlayerCreator;
use App\Player\ApplicationService\PlayerFinder;
use App\Player\ApplicationService\PlayerUpdater;
use App\Player\Infrastructure\Persistence\PdoPlayerRepository;
use App\Player\Infrastructure\WebController\PlayerController;
use App\Player\Infrastructure\WebController\PlayerCreatorController;
use App\Player\Infrastructure\WebController\PlayerUpdaterController;
use App\Team\ApplicationService\TeamCreator;
use App\Team\Infrastructure\WebController\TeamCreatorController;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use App\Team\ApplicationService\TeamSearcher;
use App\Team\Infrastructure\Persistence\PdoTeamRepository;
use App\Team\Infrastructure\WebController\TeamController;

$container = new ContainerBuilder();

// Register el repositorio
$container->register(PdoTeamRepository::class, PdoTeamRepository::class);
$container->register(PdoPlayerRepository::class, PdoPlayerRepository::class);


# Services
// Register Service `TeamSearcher`
$container->register(TeamSearcher::class, TeamSearcher::class)
    ->addArgument(new Reference(PdoTeamRepository::class));

//Register Service `TeamCreator`
$container->register(TeamCreator::class, TeamCreator::class)
    ->addArgument(new Reference(PdoTeamRepository::class));

//Register Service `PlayerByTeamSearcher`
$container->register(PlayerByTeamSearcher::class, PlayerByTeamSearcher::class)
    ->addArgument(new Reference(PdoPlayerRepository::class))
    ->addArgument(new Reference(PdoTeamRepository::class));

//Register Service `PlayerCreator`
$container->register(PlayerCreator::class, PlayerCreator::class)
    ->addArgument(new Reference(PdoPlayerRepository::class))
    ->addArgument(new Reference(PdoTeamRepository::class));

//Register Service `PlayerFinder`
$container->register(PlayerFinder::class, PlayerFinder::class)
    ->addArgument(new Reference(PdoPlayerRepository::class));

//Register Service `PlayerUpdater`
$container->register(PlayerUpdater::class, PlayerUpdater::class)
    ->addArgument(new Reference(PdoPlayerRepository::class))
    ->addArgument(new Reference(PdoTeamRepository::class));


# Controller
// Register Controller `TeamCreatorController`
$container->register(TeamCreatorController::class, TeamCreatorController::class)
    ->addArgument(new Reference(TeamCreator::class));

// Register Controller `TeamController`
$container->register(TeamController::class, TeamController::class)
    ->addArgument(new Reference(TeamSearcher::class));

// Register Controller `PlayerController`
$container->register(PlayerController::class, PlayerController::class)
    ->addArgument(new Reference(PlayerByTeamSearcher::class));

// Register Controller `PlayerCreatorController`
$container->register(PlayerCreatorController::class, PlayerCreatorController::class)
    ->addArgument(new Reference(TeamSearcher::class))
    ->addArgument(new Reference(PlayerCreator::class));

// Register Controller `PlayerUpdaterController`
$container->register(PlayerUpdaterController::class, PlayerUpdaterController::class)
    ->addArgument(new Reference(TeamSearcher::class))
    ->addArgument(new Reference(PlayerFinder::class))
    ->addArgument(new Reference(PlayerUpdater::class));

return $container;
