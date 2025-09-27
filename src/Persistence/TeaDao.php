<?php

namespace Teaki\Persistence;

use Teaki\Entity\Tea;

class TeaDAO extends AbstractDao
{
    public const REMARKS_MAX_LENGTH = 150;

    public function create(Tea $tea, bool $returnId = false): mixed
    {
        $command = <<<COMMAND
            INSERT INTO `tea` (`name_id`, `type_id`, `origin_id`, `vendor_id`,
                `harvest_year`, `remarks`, `is_available`, `amount_in_grams`)
            VALUES (:name_id, :type_id, :origin_id, :vendor_id,
                :harvest_year, :remarks, :is_available, :amount_in_grams)
COMMAND;
        $stmt = $this->conn->prepare($command);
        $stmt->execute([
            'name_id' => $tea->getNameId(),
            'type_id' => $tea->getTypeId(),
            'origin_id' => $tea->getOriginId(),
            'vendor_id' => $tea->getVendorId(),
            'harvest_year' => $tea->getHarvestYear(),
            'remarks' => $tea->getRemarks(),
            'is_available' => $tea->getIsAvailable(),
            'amount_in_grams' => $tea->getAmount(),
        ]);
        if ($returnId) {
            return $this->conn->lastInsertId();
        }
        return null;
    }

    public function update(Tea $tea): bool
    {
        $command = <<<COMMAND
            UPDATE `tea`
            SET `name_id` = :name_id, `type_id` = :type_id, `origin_id` = :origin_id,
                `vendor_id` = :vendor_id, `harvest_year` = :harvest_year, `remarks` = :remarks,
                `is_available` = :is_available, `amount_in_grams` = :amount_in_grams
            WHERE `id` = :id
COMMAND;
        $stmt = $this->conn->prepare($command);
        $stmt->execute([
            'id' => $tea->getId(),
            'name_id' => $tea->getNameId(),
            'type_id' => $tea->getTypeId(),
            'origin_id' => $tea->getOriginId(),
            'vendor_id' => $tea->getVendorId(),
            'harvest_year' => $tea->getHarvestYear(),
            'remarks' => $tea->getRemarks(),
            'is_available' => $tea->getIsAvailable(),
            'amount_in_grams' => $tea->getAmount(),
        ]);
        return $stmt->rowCount() === 1;
    }
}
