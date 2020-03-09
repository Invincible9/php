<?php


namespace App\Repository;


use App\Data\PhysicalEntityDTO;

interface PhysicalEntityRepositoryInterface
{
    public function insert(PhysicalEntityDTO $physicalEntityDTO) : bool;

}