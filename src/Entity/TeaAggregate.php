<?php

namespace Teaki\Entity;

class TeaAggregate extends Tea implements \JsonSerializable
{
    /** @var string */
    private $name;
    /** @var string */
    private $vendor;
    /** @var string */
    private $origin;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getVendor(): ?string
    {
        return $this->vendor;
    }

    public function setVendor(string $vendor): void
    {
        $this->vendor = $vendor;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): void
    {
        $this->origin = $origin;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
