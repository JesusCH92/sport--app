<?php

declare(strict_types=1);

namespace App\Team\Infrastructure\WebController;

final class TeamController
{
    public const string PATH = '/';

    public function __invoke()
    {
        echo 'Team Controller';
    }
}