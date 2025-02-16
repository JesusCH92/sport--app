<?php

declare(strict_types=1);

namespace App\Player\Domain\Exception;

use Exception;
use Throwable;

final class NotFoundPlayer extends Exception
{
    private const string NOT_FOUND_WITH_ID_MESSAGE = 'Player not found with UUID: ';

    public function __construct(string $uuid, int $code = 404, Throwable $previous = null)
    {
        parent::__construct(self::NOT_FOUND_WITH_ID_MESSAGE . $uuid, $code, $previous);
    }
}
