<?php
namespace App\Repositories\Admin;

use App\Interfaces\Admin\AuthRepositoryInterface;
use App\Interfaces\Admin\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class EloquentAuthRepository implements AuthRepositoryInterface
{
    public function attemptLogin(array $credentials)
    {
        return Auth::attempt($credentials);
    }

    public function logout($request): \Illuminate\Http\JsonResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message'=>'Admin has been logout']);
    }
}
