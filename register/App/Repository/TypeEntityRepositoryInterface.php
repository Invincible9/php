<?php


namespace App\Repository;


use App\Data\TypeEntityDTO;

interface TypeEntityRepositoryInterface
{
    /**
     * @return \Generator|TypeEntityDTO[]
     */
    public function findAll() : \Generator;

    public function findOneById(int $id): TypeEntityDTO;

}