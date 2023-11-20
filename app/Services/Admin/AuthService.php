<?php


namespace App\Services\Admin;

use App\Interfaces\Admin\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function attemptLogin(array $credentials)
    {
        if ($this->authRepository->attemptLogin($credentials)) {
            return true;
        }

        return false;
    }

    public function logout($request): \App\Interfaces\Admin\RedirectResponse
    {
        return $this->authRepository->logout($request);


    }
}
