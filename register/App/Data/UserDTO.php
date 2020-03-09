<?php

namespace App\Data;


use Exception;

class UserDTO
{
    private const USERNAME_MIN_LENGTH = 2;
    private const USERNAME_MAX_LENGTH = 255;

    private const PASSWORD_MIN_LENGTH = 6;
    private const PASSWORD_MAX_LENGTH = 255;

    private $id;
    private $username;
    private $password;
    /**
     * @var TypeEntityDTO
     */
    private $typeEntity;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @throws \Exception
     */
    public function setUsername($username)
    {
        DTOValidator::validate(self::USERNAME_MIN_LENGTH, self::USERNAME_MAX_LENGTH,
            $username, "text", "Username");
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @throws \Exception
     */
    public function setPassword($password)
    {
        DTOValidator::validate(self::PASSWORD_MIN_LENGTH, self::PASSWORD_MAX_LENGTH,
            $password, "text", "Password");
        $this->password = $password;
    }

    /**
     * @return TypeEntityDTO
     */
    public function getTypeEntity(): TypeEntityDTO
    {
        return $this->typeEntity;
    }

    /**
     * @param TypeEntityDTO $typeEntity
     */
    public function setTypeEntity(TypeEntityDTO $typeEntity)
    {
        $this->typeEntity = $typeEntity;
    }
}