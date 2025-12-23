<?php

namespace App\Http\Controllers\Api\Converters;

class IngredientTypeJsonModelConverter extends JsonModelConverter 
{
    public function convert($model, int $options = JsonModelConverterOptions::None)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
        ];
    }
}