<?php

namespace App\Http\Controllers\Api\Converters;

class MenuJsonModelConverter extends JsonModelConverter 
{
    private RecipeJsonModelConverter $recipeConverter;

    public function convert($model, int $options = JsonModelConverterOptions::None)
    {
        $result = [
            'id' => $model->id,
            'name' => $model->name,
            'tags' => $model->tags,
        ];

        if (JsonModelConverterOptions::hasOption($options, JsonModelConverterOptions::Recipes)) 
        {
            $result['recipes'] = [];

            foreach ($model->recipeMenus as $recipeMenu) {
                $convertedRecipe = $this->recipeConverter->convert($recipeMenu->recipe, $options);
                $convertedRecipe['position'] = $recipeMenu->position;

                $result['recipes'][] = $convertedRecipe;
            }
        }

        return $result;        
    }

    public function __construct(RecipeJsonModelConverter $recipeConverter)
    {
        $this->recipeConverter = $recipeConverter;
    }
}