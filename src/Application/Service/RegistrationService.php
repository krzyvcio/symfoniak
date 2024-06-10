<?php

namespace App\Application\Service;

use App\Domain\Entity\User;
use App\Domain\Event\UserRegisteredEvent;
use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationService
{

    public function __construct(
        private UserRepositoryInterface     $userRepository,
        private UserPasswordHasherInterface $passwordHasher,
        private EventDispatcherInterface    $eventDispatcher,
    )
    {

    }

    public function registerUser(User $user, string $plainPassword): void
    {
        $user->setPassword(
            $this->passwordHasher->hashPassword($user, $plainPassword)
        );

        $this->userRepository->save($user);

        $this->eventDispatcher->dispatch(new UserRegisteredEvent($user));

    }
}
