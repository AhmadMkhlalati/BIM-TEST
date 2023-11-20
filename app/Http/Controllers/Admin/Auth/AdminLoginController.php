<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Services\Admin\AuthService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminLoginController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function create()
    {
        return Inertia::render('Auth/login');
    }

    public function store(AdminLoginRequest $request)
    {
        if ($this->authService->attemptLogin($request->validated())) {
            $request->session()->regenerate();
            return redirect()->intended('transaction.index');
        }

        return response()->json(['message' => 'The provided credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }
}
