<?php

namespace App\Http\Requests;

class IngredientRequest extends BaseRequest
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
            'ingredienttypeid' => 'required|exists:ingredienttypes,id',
        ];
    }
}