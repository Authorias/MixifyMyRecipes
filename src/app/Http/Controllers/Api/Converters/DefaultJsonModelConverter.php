<?php

namespace App\Http\Controllers\Api\Converters;

class DefaultJsonModelConverter extends JsonModelConverter 
{
    public function convert($model, int $options = JsonModelConverterOptions::None)
    {
        return $model;
    }
}