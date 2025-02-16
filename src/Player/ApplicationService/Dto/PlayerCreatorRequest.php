<?php

declare(strict_types=1);

namespace App\Player\ApplicationService\Dto;

final readonly class PlayerCreatorRequest
{
    public function __construct(
        public string $name,
        public int    $number,
        public string $teamUuid,
        public bool   $isCaptain
    ) {
    }
}
