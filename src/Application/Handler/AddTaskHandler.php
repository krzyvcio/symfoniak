<?php

// src/Application/Handler/AddTaskHandler.php

namespace App\Application\Handler;

use App\Application\Command\AddTaskCommand;
use App\Application\Service\TaskService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class AddTaskHandler
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(AddTaskCommand $command): void
    {
        $this->taskService->addTask($command->getUserId(), $command->getTitle(), $command->getDescription());
    }
}
