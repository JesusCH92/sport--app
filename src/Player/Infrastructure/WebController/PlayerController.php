<?php

declare(strict_types=1);

namespace App\Player\Infrastructure\WebController;

use App\Common\Infrastructure\WebController;
use App\Player\ApplicationService\PlayerByTeamSearcher;
use App\Player\Infrastructure\Persistence\PdoPlayerRepository;
use App\Team\Infrastructure\Persistence\PdoTeamRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PlayerController extends WebController
{
    public const string PATH = '/player';

    public function __invoke(Request $request): Response
    {
        $service = $this->searcherService();

        $response = $service($request->get('teamUuid'));

        return $this->renderView(['players' => $response->players->items(), 'team' => $response->team,]);
    }

    private function renderView(array $vars): Response
    {
        $content = $this->renderTemplate('/../../View/player/index.php', $vars);

        return new Response($this->renderBaseTemplate($content, 'Player List'), Response::HTTP_OK);
    }

    private function searcherService(): PlayerByTeamSearcher
    {
        return new PlayerByTeamSearcher(new PdoPlayerRepository(), new PdoTeamRepository());
    }
}