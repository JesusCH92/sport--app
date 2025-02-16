<?php

declare(strict_types=1);

namespace App\Team\Domain\Entity;

use App\Team\Domain\ValueObject\City;
use App\Team\Domain\ValueObject\Name;
use DateTimeInterface;
use Ramsey\Uuid\Uuid;

final class Team
{
    private string $uuid;
    private Name $name;
    private City $city;
    private DateTimeInterface $createdAt;

    public function __construct(?string $uuid, string $name, string $city, DateTimeInterface $createdAt)
    {
        $this->uuid = $uuid ?? Uuid::uuid4()->toString();
        $this->name = new Name($name);
        $this->city = City::fromString($city);
        $this->createdAt = $createdAt;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function city(): City
    {
        return $this->city;
    }

    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }
}
