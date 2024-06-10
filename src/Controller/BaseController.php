<?php

namespace App\Controller;

use App\Domain\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


abstract class BaseController extends AbstractController
{

    protected function getUser(): ?User
    {
        $user = parent::getUser();
        if ($user instanceof User) {
            return $user;
        }

        return null;
    }
}
