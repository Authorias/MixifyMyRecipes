<?php

namespace App\Http\Requests;

class IngredientRecipeRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'ingredientid' => 'required|exists:ingredients,id',
            'recipeid' => 'required|exists:recipes,id',
            'unitid' => 'required|exists:units,id',
            'quantity' => 'required|integer',
        ];
    }
}