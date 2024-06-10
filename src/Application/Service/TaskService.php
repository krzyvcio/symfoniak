<?php

namespace App\Application\Service;

use App\Domain\Entity\Task;
use App\Domain\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class TaskService
{
    private UserRepositoryInterface $userRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(UserRepositoryInterface $userRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    public function addTask(int $userId, string $title, ?string $description): void
    {
        $user = $this->userRepository->find($userId);

        if (!$user) {
            throw new \Exception('User not found');
        }

        $task = new Task($title, $description, $user);
        $user->addTask($task);

        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }
}
