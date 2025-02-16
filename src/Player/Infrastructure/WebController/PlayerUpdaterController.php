<?php

declare(strict_types=1);

namespace App\Player\Infrastructure\WebController;

use App\Common\Infrastructure\WebController;
use App\Player\ApplicationService\Dto\PlayerUpdaterRequest;
use App\Player\ApplicationService\PlayerFinder;
use App\Player\ApplicationService\PlayerUpdater;
use App\Team\ApplicationService\TeamSearcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PlayerUpdaterController extends WebController
{
    public const string PATH = '/player-updater';
    private TeamSearcher $teamSearcher;
    private PlayerFinder $playerFinder;
    private PlayerUpdater $playerUpdater;

    public function __construct(TeamSearcher $teamSearcher, PlayerFinder $playerFinder, PlayerUpdater $playerUpdater)
    {
        $this->teamSearcher = $teamSearcher;
        $this->playerFinder = $playerFinder;
        $this->playerUpdater = $playerUpdater;
    }

    public function __invoke(Request $request): Response
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            $playerUpdaterRequest = new PlayerUpdaterRequest(
                $request->get('playerUuid'),
                $request->get('name'),
                (int)$request->get('number'),
                $request->get('team_uuid'),
                (bool)$request->get('is_captain')
            );

            $player = ($this->playerUpdater)($playerUpdaterRequest);

            return new Response('', Response::HTTP_FOUND, [
                'Location' => PlayerController::PATH . '?teamUuid=' . $player->teamUuid()
            ]);
        }

        $teams = ($this->teamSearcher)();
        $player = ($this->playerFinder)($request->get('playerUuid'));

        return $this->renderView(['teams' => $teams->items(), 'player' => $player]);
    }

    private function renderView(array $vars): Response
    {
        $content = $this->renderTemplate('/../../View/player-updater/index.php', $vars);

        return new Response($this->renderBaseTemplate($content, 'Player Updater'), Response::HTTP_OK);
    }
}
