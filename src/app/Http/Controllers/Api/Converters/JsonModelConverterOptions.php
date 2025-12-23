<?php

namespace App\Http\Controllers\Api\Converters;

class JsonModelConverterOptions
{
    const None = 0;
    const Ingredients = 1;
    const Recipes = 2;

    public static function hasOption($options, $optionToCheck): bool
    {
        return ($options & $optionToCheck) === $optionToCheck;
    }
}