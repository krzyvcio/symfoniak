<?php

namespace App\Presentation\Controller;

use App\Application\Service\UserService;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends BaseController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    #[Route('/verify-user/{id}', name: 'verify_user', methods: ['POST'])]
    public function verifyUser(int $id): JsonResponse
    {
        try {
            $this->userService->verifyUser($id);
            return new JsonResponse(['status' => 'User verified'], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], JsonResponse::HTTP_NOT_FOUND);
        }
    }
}
