<?php

// src/Domain/Service/UserServiceInterface.php
namespace App\Domain\Service;

interface UserServiceInterface
{
    public function verifyUser(int $id): void;
}
