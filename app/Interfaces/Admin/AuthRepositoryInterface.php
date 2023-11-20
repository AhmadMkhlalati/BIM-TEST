<?php

namespace App\Interfaces\Admin;

interface AuthRepositoryInterface
{
    public function attemptLogin(array $credentials);
    public function logout($request);
}
