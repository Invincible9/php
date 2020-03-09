<?php


namespace App\Repository;


use App\Data\PhysicalEntityDTO;

class PhysicalEntityRepository extends DataBaseAbstract implements PhysicalEntityRepositoryInterface
{
    public function insert(PhysicalEntityDTO $physicalEntityDTO): bool
    {
        var_dump($physicalEntityDTO);
        $this->db->query(
            "INSERT INTO physical_entity(name, middle_name, last_name, egn, user_id)
                  VALUES(?,?,?,?,?)
             "
        )->execute([
            $physicalEntityDTO->getName(),
            $physicalEntityDTO->getMiddleName(),
            $physicalEntityDTO->getLastName(),
            $physicalEntityDTO->getEgn(),
            $physicalEntityDTO->getUser()->getId()
        ]);

        return true;
    }
}