<?php

namespace App\Http\Controllers\Api\Converters;

class RecipeJsonModelConverter extends JsonModelConverter 
{
    private RecipeTypeJsonModelConverter $recipeTypeConverter;
    private UnitJsonModelConverter $unitConverter;
    private IngredientJsonModelConverter $ingredientConverter;

    public  function convert($model, int $options = JsonModelConverterOptions::None)
    {
        $result = [
            'id' => $model->id,
            'name' => $model->name,
            'tags' => $model->tags,
            'preparation' => $model->preparation,
            'numberofpeople' => $model->numberofpeople,
            'preparationtime' => $model->preparationtime,
            'type' => $this->recipeTypeConverter->convert($model->type, $options),
        ];

        if (JsonModelConverterOptions::hasOption($options, JsonModelConverterOptions::Ingredients))
        {
            $result['ingredients'] = [];

            foreach ($model->ingredientRecipes as $ingredientRecipe) {
                $convertedIngredient = $this->ingredientConverter->convert($ingredientRecipe->ingredient, $options);
                $convertedIngredient['unit'] = $this->unitConverter->convert($ingredientRecipe->unit, $options);
                $convertedIngredient['quantity'] = $ingredientRecipe->quantity;

                $result['ingredients'][] = $convertedIngredient;
            }
        }

        return $result;        
    }

    public function __construct(
        RecipeTypeJsonModelConverter $recipeTypeConverter,
        UnitJsonModelConverter $unitConverter,
        IngredientJsonModelConverter $ingredientConverter
    ) {
        $this->recipeTypeConverter = $recipeTypeConverter;
        $this->unitConverter = $unitConverter;
        $this->ingredientConverter = $ingredientConverter;
    }
}