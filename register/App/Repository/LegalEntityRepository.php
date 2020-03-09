<?php


namespace App\Repository;


use App\Data\LegalEntityDTO;

class LegalEntityRepository extends DataBaseAbstract implements LegalEntityRepositoryInterface
{

    public function insert(LegalEntityDTO $legalEntityDTO): bool
    {
        $this->db->query(
            "INSERT INTO legal_entity(company_name, tax_id, user_id)
                  VALUES(?,?,?)
             "
        )->execute([
            $legalEntityDTO->getCompanyName(),
            $legalEntityDTO->getTaxId(),
            $legalEntityDTO->getUser()->getId()
        ]);

        return true;
    }
}