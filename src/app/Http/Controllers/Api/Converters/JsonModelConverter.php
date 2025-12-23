<?php

namespace App\Http\Controllers\Api\Converters;

abstract class JsonModelConverter
{
    public abstract function convert($model, int $options = JsonModelConverterOptions::None);
}