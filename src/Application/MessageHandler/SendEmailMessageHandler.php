<?php

namespace App\Application\MessageHandler;

use App\Application\Message\SendEmailMessage;
use App\Application\Service\FakeEmailService;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SendEmailMessageHandler
{
    private FakeEmailService $fakeEmailService;
    private LoggerInterface $logger;

    public function __construct(FakeEmailService $fakeEmailService, LoggerInterface $logger)
    {
        $this->fakeEmailService = $fakeEmailService;
        $this->logger = $logger;
    }

    public function __invoke(SendEmailMessage $message): void
    {
        $user = $message->getUser();
        $emailSent = $this->fakeEmailService->sendEmail($user);

        if ($emailSent) {
            $this->logger->info(sprintf('Wysłano e-mail do %s (%s)', $user->getFirstName(), $user->getEmail()));
        } else {
            $this->logger->error(sprintf('Nie udało się wysłać e-maila do %s (%s)', $user->getFirstName(), $user->getEmail()));
        }
    }
}
