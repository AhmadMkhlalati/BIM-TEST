<?php
namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserLoginController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(UserRequest $request)
    {

        try {
            $response = $this->userService->createUser($request->validated());
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function login(UserLoginRequest $request)
    {

        $response = $this->userService->loginUser($request->email, $request->password);

        return response()->json($response, 200);
    }
}
