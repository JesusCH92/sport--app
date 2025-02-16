<?php

declare(strict_types=1);

namespace App\Player\Infrastructure\WebController;

use App\Common\Infrastructure\WebController;
use App\Player\ApplicationService\Dto\PlayerCreatorRequest;
use App\Player\ApplicationService\PlayerCreator;
use App\Team\ApplicationService\TeamSearcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PlayerCreatorController extends WebController
{
    public const string PATH = '/player-creator';
    private TeamSearcher $teamSearcher;
    private PlayerCreator $playerCreator;

    public function __construct(TeamSearcher $teamSearcher, PlayerCreator $playerCreator)
    {
        $this->teamSearcher = $teamSearcher;
        $this->playerCreator = $playerCreator;
    }

    public function __invoke(Request $request): Response
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            $playerCreatorRequest = new PlayerCreatorRequest(
                $request->get('name'),
                (int)$request->get('number'),
                $request->get('team_uuid'),
                (bool)$request->get('is_captain'),
            );

            $player = ($this->playerCreator)($playerCreatorRequest);

            return new Response('', Response::HTTP_FOUND, [
                'Location' => PlayerController::PATH . '?teamUuid=' . $player->teamUuid()
            ]);
        }

        $teams = ($this->teamSearcher)();

        return $this->renderView(['teams' => $teams->items()]);
    }

    private function renderView(array $vars): Response
    {
        $content = $this->renderTemplate('/../../View/player-creator/index.php', $vars);

        return new Response($this->renderBaseTemplate($content, 'Player Creator'), Response::HTTP_OK);
    }
}
