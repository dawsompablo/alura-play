<?php

namespace Alura\Mvc\Repository;

use PDO;

class UserRepository
{
    public function __construct(private PDO $pdo)
    {
    }
}
