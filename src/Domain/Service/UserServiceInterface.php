<?php

// src/Domain/Service/UserServiceInterface.php
namespace App\Domain\Service;

use App\Domain\Model\User;

interface UserServiceInterface
{
    public function verifyUser(int $id): void;
}
