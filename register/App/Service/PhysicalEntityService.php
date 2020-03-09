<?php


namespace App\Service;


use App\Data\PhysicalEntityDTO;
use App\Repository\PhysicalEntityRepositoryInterface;

class PhysicalEntityService implements PhysicalEntityServiceInterface
{
    /**
     * @var PhysicalEntityRepositoryInterface
     */
    private $physicalEntityRepository;

    public function __construct(PhysicalEntityRepositoryInterface $physicalEntityRepository)
    {
        $this->physicalEntityRepository = $physicalEntityRepository;
    }


    public function register(PhysicalEntityDTO $physicalEntityDTO): bool
    {
        return $this->physicalEntityRepository->insert($physicalEntityDTO);
    }
}