<?php


namespace App\Service;


use App\Data\LegalEntityDTO;

interface LegalEntityServiceInterface
{
    public function register(LegalEntityDTO $legalEntityDTO) : bool;
}