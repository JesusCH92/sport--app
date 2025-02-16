<?php

declare(strict_types=1);

namespace App\Player\Domain\Entity;

use App\Player\Domain\ValueObject\Name;
use App\Player\Domain\ValueObject\Number;
use Ramsey\Uuid\Uuid;

final class Player
{
    private string $uuid;
    private Name $name;
    private Number $number;
    private string $teamUuid;
    private bool $isCaptain;

    public function __construct(?string $uuid, string $name, int $number, string $teamUuid, bool $isCaptain = false)
    {
        $this->uuid = $uuid ?? Uuid::uuid4()->toString();
        $this->name = new Name($name);
        $this->number = new Number($number);
        $this->teamUuid = $teamUuid;
        $this->isCaptain = $isCaptain;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function number(): Number
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
        $this->name = new Name($name);
        $this->number = new Number($number);
        $this->teamUuid = $teamUuid;
        $this->isCaptain = $isCaptain;
    }
}
