<?php


namespace App\Service;


use App\Data\TypeEntityDTO;

interface TypeEntityServiceInterface
{
    /**
     * @return \Generator|TypeEntityDTO[]
     */
    public function getAll(): \Generator;

    public function getOneById(int $id) : TypeEntityDTO;
}