<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(): View
    {
        $urlBase = url()->to('/');
        $urlPrevious = url()->previous();
        
        // Set the previous url that we came from to redirect to after successful login but only if is internal
        if (($urlPrevious != $urlBase . '/login') && (substr($urlPrevious, 0, strlen($urlBase)) === $urlBase)) {
            session()->put('url.intended', $urlPrevious);
        }        

        return view('login', ['title' => 'Inloggen', 'name' => old('name')]);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials))
        {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return redirect('login')->withErrors(['password' => 'Ongeldige naam en/of wachtwoord']);
    }

    public function logout(): RedirectResponse 
    {
        Auth::logout();

        return redirect('');
    }
}