<?php

namespace TeaTracker\Entity;

class TeaAggregate implements \JsonSerializable
{
    /** @var id */
    private $id;
    /** @var string */
    private $name;
    /** @var int */
    private $typeId;
    /** @var int|null */
    private $harvestYear;
    /** @var bool */
    private $isAvailable;
    /** @var string */
    private $vendor;
    /** @var string */
    private $origin;
    /** @var string|null */
    private $alias;
    /** @var int */
    private $amount;
    /** @var string */
    private $remarks;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getTypeId(): ?int
    {
        return $this->typeId;
    }

    public function setTypeId(int $typeId): void
    {
        $this->typeId = $typeId;
    }

    public function getHarvestYear(): ?int
    {
        return $this->harvestYear;
    }

    public function setHarvestYear(?int $harvestYear): void
    {
        $this->harvestYear = $harvestYear;
    }

    public function getIsAvailable(): ?bool
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(bool $isAvailable): void
    {
        $this->isAvailable = $isAvailable;
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

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): void
    {
        $this->alias = $alias;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    public function setRemarks(?string $remarks): void
    {
        $this->remarks = $remarks;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
