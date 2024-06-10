<?php

namespace App\Command;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:verify-user',
    description: 'Verify a user by their ID'
)]
class VerifyUserCommand extends Command
{
    private $userRepository;
    private $entityManager;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager)
    {
        parent::__construct();

        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('id', InputArgument::REQUIRED, 'The ID of the user to verify');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $userId = $input->getArgument('id');

        $user = $this->userRepository->find($userId);

        if (!$user) {
            $io->error(sprintf('User with ID %d not found.', $userId));
            return Command::FAILURE;
        }

        $user->setVerified(true);
        $this->entityManager->flush();

        $io->success(sprintf('User with ID %d has been verified.', $userId));

        return Command::SUCCESS;
    }
}
