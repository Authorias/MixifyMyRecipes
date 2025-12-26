<?php

namespace App\Http\Requests;

class AuthenticationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|email|max:255',
            'password' => 'required|string|min:8',
        ];
    }
}