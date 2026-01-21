<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\AuthenticationRequest;
use App\Models\User;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\JsonResponse;

class AuthenticationController extends ApiController {
    /**
     * POST : api/authentication/login
     * Authenticate a user and return a token.
     */
    public function login(AuthenticationRequest $request) {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            /** @var User $user */
            $user = Auth::user();
            $token = $user->createToken('authToken')->accessToken;

            return JsonResponse::success($this->getConverter()->convert($token));
        }

        return JsonResponse::error('Ongeldige gebruikersnaam of wachtwoord.', Response::HTTP_UNAUTHORIZED);
    }

    /**
     * POST : api/authentication/logout
     * Logout the authenticated user.
     */
    public function logout() {
        Auth::logout();

        return JsonResponse::success(null);
    }
}