<?php

declare(strict_types=1);

namespace App\Common\Domain\ValueObject;

abstract class IntegerValueObject
{
    protected ?int $value;

    public function __construct(?int $value)
    {
        $this->setValue($value);
    }

    private function setValue(?int $value): void
    {
        $this->saveIfIsAllowed($value);
        $this->value = $value;
    }

    abstract protected function saveIfIsAllowed(?int $value): void;

    public function value(): ?int
    {
        return $this->value;
    }
}
