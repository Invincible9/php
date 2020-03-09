<?php

namespace App\Service;


use App\Data\UserDTO;

interface UserServiceInterface
{
    public function register(UserDTO $userDTO, string $confirmPassword) : int;
    public function login(string $username, string $password) : ?UserDTO;
    public function currentUser() : ?UserDTO;
    public function isLogged() : bool;
}