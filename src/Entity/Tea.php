<?php

namespace Teaki\Entity;

class Tea
{
    /** @var int|null */
    protected $id;
    /** @var int */
    protected $typeId;
    /** @var int|null */
    protected $harvestYear;
    /** @var bool */
    protected $isAvailable;
    /** @var int */
    protected $amount;
    /** @var string|null */
    protected $alias;
    /** @var string|null */
    protected $remarks;
    /** @var string */
    private $nameId;
    /** @var int */
    private $vendorId;
    /** @var int */
    private $originId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getTypeId(): int
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

    public function getIsAvailable(): bool
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(bool $isAvailable): void
    {
        $this->isAvailable = $isAvailable;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): void
    {
        $this->alias = $alias;
    }

    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    public function setRemarks(?string $remarks): void
    {
        $this->remarks = $remarks;
    }

    public function getNameId(): int
    {
        return $this->nameId;
    }

    public function setNameId(int $nameId): void
    {
        $this->nameId = $nameId;
    }

    public function getVendorId(): int
    {
        return $this->vendorId;
    }

    public function setVendorId(int $vendorId): void
    {
        $this->vendorId = $vendorId;
    }

    public function getOriginId(): int
    {
        return $this->originId;
    }

    public function setOriginId(int $originId): void
    {
        $this->originId = $originId;
    }
}
