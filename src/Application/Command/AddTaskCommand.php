<?php


namespace App\Application\Command;

class AddTaskCommand
{
    private int $userId;
    private string $title;
    private ?string $description;

    public function __construct(int $userId, string $title, ?string $description)
    {
        $this->userId = $userId;
        $this->title = $title;
        $this->description = $description;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
