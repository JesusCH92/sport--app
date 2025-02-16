<?php

declare(strict_types=1);

namespace App\Team\Infrastructure\WebController;

use App\Common\Infrastructure\WebController;
use App\Team\ApplicationService\Dto\TeamCreatorRequest;
use App\Team\ApplicationService\TeamCreator;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class TeamCreatorController extends WebController
{
    public const string PATH = '/team-creator';

    private TeamCreator $teamCreator;

    public function __construct(TeamCreator $teamCreator)
    {
        $this->teamCreator = $teamCreator;
    }

    public function __invoke(Request $request): Response
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            $teamCreatorRequest = new TeamCreatorRequest(
                $request->get('name'),
                $request->get('city'),
                new DateTimeImmutable()
            );

            ($this->teamCreator)($teamCreatorRequest);

            return new Response('', Response::HTTP_FOUND, [
                'Location' => TeamController::PATH
            ]);
        }

        return $this->renderView();
    }

    private function renderView(): Response
    {
        $content = $this->renderTemplate('/../../View/team-creator/index.php');

        return new Response($this->renderBaseTemplate($content, 'Team Creator'), Response::HTTP_OK);
    }
}