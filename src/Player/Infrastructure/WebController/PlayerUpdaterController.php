<?php

declare(strict_types=1);

namespace App\Player\Infrastructure\WebController;

use App\Common\Infrastructure\WebController;
use App\Player\ApplicationService\Dto\PlayerUpdaterRequest;
use App\Player\ApplicationService\PlayerFinder;
use App\Player\ApplicationService\PlayerUpdater;
use App\Player\Infrastructure\Persistence\PdoPlayerRepository;
use App\Team\ApplicationService\TeamSearcher;
use App\Team\Infrastructure\Persistence\PdoTeamRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PlayerUpdaterController extends WebController
{
    public const string PATH = '/player-updater';

    public function __invoke(Request $request): Response
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            $playerUpdaterRequest = new PlayerUpdaterRequest(
                $request->get('playerUuid'),
                $request->get('name'),
                (int)$request->get('number'),
                $request->get('team_uuid'),
                (bool)$request->get('is_captain')
            );//dump($playerUpdaterRequest);exit;die();

            $service = $this->playerUpdaterService();
            $player = $service($playerUpdaterRequest);

            return new Response('', Response::HTTP_FOUND, [
                'Location' => PlayerController::PATH . '?teamUuid=' . $player->teamUuid()
            ]);
        }

        $searcherService = $this->teamSearcherService();
        $playerFinder = $this->playerFinderService();

        $teams = $searcherService();
        $player = $playerFinder($request->get('playerUuid'));

        return $this->renderView(['teams' => $teams->items(), 'player' => $player]);
    }

    private function renderView(array $vars): Response
    {
        $content = $this->renderTemplate('/../../View/player-updater/index.php', $vars);

        return new Response($this->renderBaseTemplate($content, 'Player Updater'), Response::HTTP_OK);
    }

    private function teamSearcherService(): TeamSearcher
    {
        return new TeamSearcher(new PdoTeamRepository());
    }

    private function playerFinderService(): PlayerFinder
    {
        return new PlayerFinder(new PdoPlayerRepository());
    }

    private function playerUpdaterService(): PlayerUpdater
    {
        return new PlayerUpdater(new PdoPlayerRepository(), new PdoTeamRepository());
    }
}
