<?php


namespace App\Repository;


use App\Data\TypeEntityDTO;

class TypeEntityRepository extends DataBaseAbstract implements TypeEntityRepositoryInterface
{
    /**
     * @return \Generator|TypeEntityDTO[]
     */
    public function findAll(): \Generator
    {
        return $this->db->query(
            "
                SELECT 
                    id,
                    name
                FROM type_entity
            ")->execute()
            ->fetch(TypeEntityDTO::class);
    }

    public function findOneById(int $id): TypeEntityDTO
    {
        return $this->db->query(
            "
                SELECT 
                    id,
                    name
                FROM type_entity
                WHERE id = ?
            ")->execute([$id])
            ->fetch(TypeEntityDTO::class)
            ->current();
    }
}