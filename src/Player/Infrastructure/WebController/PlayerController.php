<?php

declare(strict_types=1);

namespace App\Player\Infrastructure\WebController;

use App\Common\Infrastructure\WebController;
use App\Player\ApplicationService\PlayerByTeamSearcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PlayerController extends WebController
{
    public const string PATH = '/player';
    private PlayerByTeamSearcher $playerByTeamSearcher;

    public function __construct(PlayerByTeamSearcher $playerByTeamSearcher)
    {
        $this->playerByTeamSearcher = $playerByTeamSearcher;
    }

    public function __invoke(Request $request): Response
    {
        $response = ($this->playerByTeamSearcher)($request->get('teamUuid'));

        return $this->renderView(['players' => $response->players->items(), 'team' => $response->team,]);
    }

    private function renderView(array $vars): Response
    {
        $content = $this->renderTemplate('/../../View/player/index.php', $vars);

        return new Response($this->renderBaseTemplate($content, 'Player List'), Response::HTTP_OK);
    }
}