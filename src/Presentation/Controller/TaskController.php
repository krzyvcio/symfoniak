<?php

namespace App\Presentation\Controller;

use App\Application\Command\AddTaskCommand;
use App\Controller\BaseController;
use App\Domain\Form\TaskFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends BaseController
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    #[Route('/task/add', name: 'task_add', methods: ['GET', 'POST'])]
    public function addTask(Request $request): Response
    {
        $user = $this->getUser();

        if (!$user) {
            // Przekierowanie do strony logowania lub wyświetlenie komunikatu o błędzie
            return $this->redirectToRoute('app_login');
        }

        $command = new AddTaskCommand($user->getId(), '', '');
        $form = $this->createForm(TaskFormType::class, $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->messageBus->dispatch($command);

            return $this->redirectToRoute('task_list');
        }

        return $this->render('task/add.html.twig', [
            'taskForm' => $form->createView(),
        ]);
    }
}
