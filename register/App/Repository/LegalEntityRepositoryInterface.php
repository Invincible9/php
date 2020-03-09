<?php


namespace App\Repository;


use App\Data\LegalEntityDTO;

interface LegalEntityRepositoryInterface
{
    public function insert(LegalEntityDTO $legalEntityDTO) : bool;
}