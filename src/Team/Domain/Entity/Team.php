<?php

declare(strict_types=1);

namespace App\Team\Domain\Entity;

use DateTimeInterface;
use Ramsey\Uuid\Uuid;

final class Team
{
    private string $uuid;
    private string $name;
    private string $city;
    private DateTimeInterface $createdAt;

    public function __construct(?string $uuid, string $name, string $city, DateTimeInterface $createdAt)
    {
        $this->uuid = $uuid ?? Uuid::uuid4()->toString();
        $this->name = $name;
        $this->city = $city;
        $this->createdAt = $createdAt;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function city(): string
    {
        return $this->city;
    }

    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }
}
