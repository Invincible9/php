<?php

namespace App\Repository;


use App\Data\UserDTO;

class UserRepository extends DataBaseAbstract implements UserRepositoryInterface
{
    public function insert(UserDTO $userDTO): int
    {
        $this->db->query(
            "INSERT INTO users(username, password, type_entity_id)
                  VALUES(?,?,?)
             "
        )->execute([
            $userDTO->getUsername(),
            $userDTO->getPassword(),
            $userDTO->getTypeEntity()->getId()
        ]);

        return $this->db->lastId();
    }

//    public function update(int $id, UserDTO $userDTO): bool
//    {
//        $this->db->query(
//            "
//                UPDATE users
//                SET
//                  username = ?,
//                  password = ?,
//                  first_name = ?,
//                  last_name = ?,
//                  born_on = ?
//                WHERE id = ?
//            "
//        )->execute([
//            $userDTO->getUsername(),
//            $userDTO->getPassword(),
//            $userDTO->getFirstName(),
//            $userDTO->getLastName(),
//            $userDTO->getBornOn(),
//            $id
//        ]);
//
//        return true;
//    }
//
//    public function delete(int $id): bool
//    {
//        $this->db->query("DELETE FROM users WHERE id = ?")
//            ->execute([$id]);
//
//        return true;
//    }
//
    public function findOneByUsername(string $username): ?UserDTO
    {
        return $this->db->query(
            "SELECT id,
                    username,
                    password
                  FROM users
                  WHERE username = ?
             "
        )->execute([$username])
            ->fetch(UserDTO::class)
            ->current();

    }

    public function findOneById(int $id): ?UserDTO
    {
        return $this->db->query(
            "SELECT id,
                    username,
                    password
                  FROM users
                  WHERE id = ?
             "
        )->execute([$id])
            ->fetch(UserDTO::class)
            ->current();
    }
//
//    /**
//     * @return \Generator|UserDTO[]
//     */
//    public function findAll(): \Generator
//    {
//        return $this->db->query(
//            "
//                  SELECT id,
//                      username,
//                      password,
//                      first_name AS firstName,
//                      last_name AS lastName,
//                      born_on as bornOn
//                  FROM users
//            "
//        )->execute()
//            ->fetch(UserDTO::class);
//    }
}