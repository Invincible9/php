<?php


namespace App\Data;


use Exception;

class LegalEntityDTO
{
    private const NAME_MIN_LENGTH = 2;
    private const NAME_MAX_LENGTH = 255;

    private $companyName;
    private $taxId;

    /**
     * @var UserDTO
     */
    private $user;

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     * @throws \Exception
     */
    public function setCompanyName($companyName)
    {
        DTOValidator::validate(
            self::NAME_MIN_LENGTH,
            self::NAME_MAX_LENGTH,
            $companyName,
            "text",
            "Company Name");
        $this->companyName = $companyName;
    }

    /**
     * @return string
     */
    public function getTaxId()
    {
        return $this->taxId;
    }

    /**
     * @param string $taxId
     * @throws Exception
     */
    public function setTaxId($taxId)
    {
        if(!preg_match("/\d{9}/", $taxId)){
            throw new Exception("Invalid tax id!");
        }
        $this->taxId = $taxId;
    }

    /**
     * @return UserDTO
     */
    public function getUser(): UserDTO
    {
        return $this->user;
    }

    /**
     * @param UserDTO $user
     */
    public function setUser(UserDTO $user): void
    {
        $this->user = $user;
    }
}