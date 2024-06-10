<?php
namespace App\Application\Service;

use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\Service\UserServiceInterface;

class UserService implements UserServiceInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function verifyUser(int $id): void
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            throw new \Exception('User not found');
        }

        $user->setVerified(true);
        $this->userRepository->save($user);
    }
}
