<?php

namespace App\Http\Controllers\Api\Converters;

class RecipeTypeJsonModelConverter extends JsonModelConverter 
{
    public function convert($model, int $options = JsonModelConverterOptions::None)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
        ];
    }
}