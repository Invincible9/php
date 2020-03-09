<?php

namespace App\Service;


use App\Data\UserDTO;
use App\Repository\UserRepositoryInterface;
use App\Service\Encryption\EncryptionServiceInterface;
use Exception;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var EncryptionServiceInterface
     */
    private $encryptionService;

    public function __construct(UserRepositoryInterface $userRepository,
            EncryptionServiceInterface $encryptionService)
    {
        $this->userRepository = $userRepository;
        $this->encryptionService = $encryptionService;
    }

    /**
     * @param UserDTO $userDTO
     * @param string $confirmPassword
     * @return bool
     * @throws Exception
     */
    public function register(UserDTO $userDTO, string $confirmPassword): int
    {
        if($userDTO->getPassword() !== $confirmPassword){
            throw new Exception("Password mismatch!");
        }

        if(null !== $this->userRepository->findOneByUsername($userDTO->getUsername())){
            throw new Exception("Username already taken!");
        }

        $this->encryptPassword($userDTO);
        return $this->userRepository->insert($userDTO);
    }

    /**
     * @param string $username
     * @param string $password
     * @return UserDTO|null
     * @throws Exception
     */
    public function login(string $username, string $password): ?UserDTO
    {
        $userFromDB = $this->userRepository->findOneByUsername($username);

        if(null === $userFromDB){
            throw new Exception("You may want to <a href='register.php'>register</a> first?");
        }

        if(false === $this->encryptionService->verify($password, $userFromDB->getPassword())){
            throw new Exception("Wrong password. You may forget it?");
        }

        return $userFromDB;
    }

    public function currentUser(): ?UserDTO
    {
        if(!$_SESSION['id']){
            return null;
        }

        return $this->userRepository->findOneById(intval($_SESSION['id']));
    }

    public function isLogged(): bool
    {
        if(!$this->currentUser()){
            return false;
        }
        return true;
    }

    /**
     * @param UserDTO $userDTO
     * @throws Exception
     */
    private function encryptPassword(UserDTO $userDTO): void
    {
        $plainPassword = $userDTO->getPassword();
        $passwordHash = $this->encryptionService->hash($plainPassword);
        $userDTO->setPassword($passwordHash);
    }
}