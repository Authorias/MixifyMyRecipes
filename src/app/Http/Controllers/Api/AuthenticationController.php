<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\AuthenticationRequest;
use App\Models\User;

class AuthenticationController extends ApiController
{
    /**
     * POST : api/authentication/login
     * Authenticate a user and return a token.
     */
    public function login(AuthenticationRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            /** @var User $user */
            $user = Auth::user();
            $token = $user->createToken('authToken')->accessToken;

            return JsonResponse::success($this->jsonConverter->convert($token), 200);
        }

        return JsonResponse::error('Ongeldige gebruikersnaam of wachtwoord.', 401);
    }

    /**
     * POST : api/authentication/logout
     * Logout the authenticated user.
     */
    public function logout()
    {
        Auth::logout();

        return JsonResponse::success(null, 200);
    }
}