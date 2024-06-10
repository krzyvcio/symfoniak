<?php
namespace App\Application\Handler;

use App\Application\Command\VerifyUserCommand;
use App\Domain\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class VerifyUserHandler
{
    private UserRepositoryInterface $userRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(UserRepositoryInterface $userRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    public function handle(VerifyUserCommand $command): void
    {
        $user = $this->userRepository->find($command->getUserId());

        if (!$user) {
            throw new \Exception(sprintf('User with ID %d not found.', $command->getUserId()));
        }

        $user->setIsVeryfied(true);
        $this->entityManager->flush();
    }
}

