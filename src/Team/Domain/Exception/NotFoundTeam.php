<?php

declare(strict_types=1);

namespace App\Team\Domain\Exception;

use Exception;
use Throwable;

final class NotFoundTeam extends Exception
{
    private const string NOT_FOUND_WITH_ID_MESSAGE = 'Team not found with UUID: ';

    public function __construct(string $uuid, int $code = 404, Throwable $previous = null)
    {
        parent::__construct(self::NOT_FOUND_WITH_ID_MESSAGE . $uuid, $code, $previous);
    }

}
