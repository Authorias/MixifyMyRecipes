<?php

namespace App\Http\Controllers\Api\Converters;

class MenuJsonModelConverter extends JsonModelConverter 
{
    private RecipeJsonModelConverter $recipeConverter;

    public function convert($model, int $options = JsonModelConverterOptions::None) {
        $result = [
            'id' => $model->id,
            'name' => $model->name,
            'tags' => $model->tags,
        ];

        if (JsonModelConverterOptions::hasOption($options, JsonModelConverterOptions::Recipes)) {
            $result['recipes'] = [];

            foreach ($model->menuRecipes as $menuRecipe) {
                $convertedRecipe = $this->recipeConverter->convert($menuRecipe->recipe, $options);
                $convertedRecipe['position'] = $menuRecipe->position;

                $result['recipes'][] = $convertedRecipe;
            }
        }

        return $result;        
    }

    public function __construct(RecipeJsonModelConverter $recipeConverter) {
        $this->recipeConverter = $recipeConverter;
    }
}