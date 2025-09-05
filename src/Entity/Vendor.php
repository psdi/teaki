<?php

namespace Teaki\Entity;

class Vendor implements \JsonSerializable
{
    /** @var int|null */
    private $id;
    /** @var string */
    private $value;
    /** @var int|null */
    private $locationId;

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

    public function getLocationId(): ?int
    {
        return $this->locationId;
    }

    public function setLocationId(?int $locationId): void
    {
        $this->locationId = $locationId;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
