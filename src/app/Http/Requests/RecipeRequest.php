<?php

namespace App\Http\Requests;

class RecipeRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'tags' => 'nullable|string|max:500',
            'numberofpeople' => 'nullable|integer|min:1',
            'preparation' => 'required|string',
            'preparationtime' => 'nullable|time',
            'createdby' => 'nullable|integer',
        ];
    }
}