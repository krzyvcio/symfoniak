<?php


namespace App\Domain\Repository;

use App\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function find(int $id): ?User;
    public function save(User $user): void;
    public function remove(User $user): void;
}
