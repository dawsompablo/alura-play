<?php

declare(strict_types=1);

namespace Alura\Mvc\Entity;

class User
{
    public readonly int $id;

    public function __construct(
        public string $email,
        public string $password
    ) {
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
