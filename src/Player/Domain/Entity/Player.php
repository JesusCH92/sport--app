<?php

declare(strict_types=1);

namespace App\Player\Domain\Entity;

use Ramsey\Uuid\Uuid;

final class Player
{
    private string $uuid;
    private string $name;
    private int $number;
    private string $teamUuid;
    private bool $isCaptain;

    public function __construct(?string $uuid, string $name, int $number, string $teamUuid, bool $isCaptain = false)
    {
        $this->uuid = $uuid ?? Uuid::uuid4()->toString();
        $this->name = $name;
        $this->number = $number;
        $this->teamUuid = $teamUuid;
        $this->isCaptain = $isCaptain;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function number(): int
    {
        return $this->number;
    }

    public function teamUuid(): string
    {
        return $this->teamUuid;
    }

    public function isCaptain(): bool
    {
        return $this->isCaptain;
    }

    public function modify(string $name, int $number, string $teamUuid, bool $isCaptain): void
    {
        $this->name = $name;
        $this->number = $number;
        $this->teamUuid = $teamUuid;
        $this->isCaptain = $isCaptain;
    }
}
