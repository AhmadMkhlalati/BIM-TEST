<?php


namespace App\Services\Admin;

use App\Interfaces\Admin\UserRepositoryInterface;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function searchUsers()
    {
        $users = $this->userRepository->searchUsers();

        return $users->map(function ($user) {
            return [
                'text' => $user->name,
                'value' => $user->id,
            ];
        });
    }
}
