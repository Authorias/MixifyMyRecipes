<?php

namespace App\Http\Requests;

class RecipeMenuRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'menuid' => 'required|exists:menus,id',
            'recipeid' => 'required|exists:recipes,id',
            'position' => 'required|integer|min:1',
        ];
    }
}