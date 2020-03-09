<?php


namespace App\Data;


use Exception;

class PhysicalEntityDTO
{
    private const NAME_MIN_LENGTH = 2;
    private const NAME_MAX_LENGTH = 255;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $middleName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $egn;

    /**
     * @var UserDTO
     */
    private $user;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @throws \Exception
     */
    public function setName(string $name)
    {
        DTOValidator::validate(
            self::NAME_MIN_LENGTH,
            self::NAME_MAX_LENGTH,
            $name,
            "text",
            "Name");
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * @param string $middleName
     * @throws \Exception
     */
    public function setMiddleName($middleName)
    {
        DTOValidator::validate(
            self::NAME_MIN_LENGTH,
            self::NAME_MAX_LENGTH,
            $middleName,
            "text",
            "Middle Name");

        $this->middleName = $middleName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @throws \Exception
     */
    public function setLastName($lastName)
    {
        DTOValidator::validate(
            self::NAME_MIN_LENGTH,
            self::NAME_MAX_LENGTH,
            $lastName,
            "text",
            "Last Name");
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEgn()
    {
        return $this->egn;
    }

    /**
     * @param string $egn
     * @throws Exception
     */
    public function setEgn($egn)
    {
        if(!preg_match("/^\d{10}$/", $egn)){
            throw new Exception("Invalid EGN!");
        }
        $this->egn = $egn;
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