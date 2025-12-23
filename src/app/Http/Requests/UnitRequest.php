<?php

namespace App\Http\Requests;

class UnitRequest extends BaseRequest
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
            'abbreviation' => 'required|string|max:10',
        ];
    }
}