<?php

declare(strict_types=1);

namespace App\Team\Infrastructure\WebController;

use App\Common\Infrastructure\WebController;
use App\Team\ApplicationService\TeamSearcher;
use App\Team\Infrastructure\Persistence\PdoTeamRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class TeamController extends WebController
{
    public const string PATH = '/';

    public function __invoke(Request $request): Response
    {
        $service = $this->searcherService();
        $teams = $service();

        return $this->renderView(['teams' => $teams->items()]);
    }

    private function renderView(array $vars): Response
    {
        $content = $this->renderTemplate('/../../View/team/index.php', $vars);

        return new Response($this->renderBaseTemplate($content, 'Team List'), Response::HTTP_OK);
    }

    private function searcherService(): TeamSearcher
    {
        return new TeamSearcher(new PdoTeamRepository());
    }
}