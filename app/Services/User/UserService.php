<?php

namespace App\Services\User;

use App\Interfaces\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $data)
    {
        $user = $this->userRepository->createUser($data);
        $user->token = $user->createToken('bim-token')->plainTextToken;

        return [
            'message' => 'User has been registered',
            'status' => 1,
            'user' => $user,
        ];
    }

    public function loginUser(string $email, string $password)
    {
        $user = $this->userRepository->getUserByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json(['message' => 'Error: Invalid email or password'], 401);
        }

        $user->token = $user->createToken('my-app-token')->plainTextToken;

        return [
            'message' => 'User has been logged in',
            'status' => 1,
            'user' => $user,
        ];
    }
}
