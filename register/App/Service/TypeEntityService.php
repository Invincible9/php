<?php


namespace App\Service;


use App\Data\TypeEntityDTO;
use App\Repository\TypeEntityRepositoryInterface;

class TypeEntityService implements TypeEntityServiceInterface
{

    /**
     * @var TypeEntityRepositoryInterface
     */
    private $typeEntityRepository;

    public function __construct(TypeEntityRepositoryInterface $typeEntityRepository)
    {
        $this->typeEntityRepository = $typeEntityRepository;
    }

    /**
     * @return \Generator|TypeEntityDTO[]
     */
    public function getAll(): \Generator
    {
        return $this->typeEntityRepository->findAll();
    }

    public function getOneById(int $id): TypeEntityDTO
    {
        return $this->typeEntityRepository->findOneById($id);
    }
}