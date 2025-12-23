<?php

namespace App\Http\Controllers\Api\Converters;

class IngredientJsonModelConverter extends JsonModelConverter 
{
    private IngredientTypeJsonModelConverter $ingredientTypeConverter;

    public function convert($model, int $options = JsonModelConverterOptions::None)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'type' => $this->ingredientTypeConverter->convert($model->ingredientType, $options),
        ];
    }

    public function __construct(IngredientTypeJsonModelConverter $ingredientTypeConverter)
    {
        $this->ingredientTypeConverter = $ingredientTypeConverter;
    }
}