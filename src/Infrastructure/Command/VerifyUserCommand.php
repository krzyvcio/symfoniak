<?php
declare(strict_types=1);
namespace App\Infrastructure\Command;

use App\Application\Command\VerifyUserCommand as VerifyUserAppCommand;
use App\Application\Handler\VerifyUserHandler;
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
    private VerifyUserHandler $handler;

    public function __construct(VerifyUserHandler $handler)
    {
        parent::__construct();
        $this->handler = $handler;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('id', InputArgument::REQUIRED, 'The ID of the user to verify');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $userId = (int) $input->getArgument('id');

        $command = new VerifyUserAppCommand($userId);

        try {
            $this->handler->handle($command);
            $io->success(sprintf('User with ID %d has been verified.', $userId));
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }
    }
}
