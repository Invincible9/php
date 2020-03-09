<?php


namespace App\Service;


use App\Data\PhysicalEntityDTO;

interface PhysicalEntityServiceInterface
{
    public function register(PhysicalEntityDTO $physicalEntityDTO): bool;
}