<?php

namespace Alura\Mvc\Repository;

use \PDO;

class UserRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function findByEmail(string $email): array
    {
        $sql = 'SELECT * FROM users WHERE email = ?';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $email);
        $statement->execute();

        return $statement->fetch($this->pdo::FETCH_ASSOC);
    }

    public function needsRehash(string $rawPassword, int $id): bool
    {
        if (password_needs_rehash($rawPassword, PASSWORD_ARGON2I)) {
            $statement = $this->pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
            $statement->bindValue(1, password_hash($rawPassword, PASSWORD_ARGON2ID));
            $statement->bindValue(2, $id);
            $statement->execute();

            return true;
        }

        return false;
    }
}
