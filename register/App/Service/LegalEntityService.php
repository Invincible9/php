<?php


namespace App\Service;


use App\Data\LegalEntityDTO;
use App\Repository\LegalEntityRepositoryInterface;

class LegalEntityService implements LegalEntityServiceInterface
{
    /**
     * @var LegalEntityRepositoryInterface
     */
    private $legalEntityRepository;

    public function __construct(LegalEntityRepositoryInterface $legalEntityRepository)
    {
        $this->legalEntityRepository = $legalEntityRepository;
    }

    public function register(LegalEntityDTO $legalEntityDTO): bool
    {
        return $this->legalEntityRepository->insert($legalEntityDTO);
    }
}