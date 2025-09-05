<?php

namespace Teaki\Entity;

class Location implements \JsonSerializable
{
    /** @var int|null */
    private $id;
    /** @var string */
    private $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
