<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\IngredientRequest;
use App\Models\Ingredient;

use App\Http\Controllers\Api\Converters\IngredientJsonModelConverter as JsonConverter;
use App\Http\Controllers\Api\Converters\JsonModelConverterOptions as JsonOptions;

class IngredientController extends ApiController
{
    const INGREDIENT_NOT_FOUND_MESSAGE = 'Ingredient niet gevonden.';

    /**
     * GET : api/ingredients
     * Get a listing of ingredients.
     */
    public function index()
    {
        $items = [];

        foreach (Ingredient::all() as $ingredient) {
            $items[] = $this->jsonConverter->convert($ingredient, JsonOptions::None);
        }

        return JsonResponse::success($items);
    }

    /**
     * GET : api/ingredients/{id}
     * Get a single ingredient by ID.
     */
    public function get($id)
    {
        $item = Ingredient::find($id);

        return !$item
            ? JsonResponse::error(self::INGREDIENT_NOT_FOUND_MESSAGE, 404)
            : JsonResponse::success($this->jsonConverter->convert($item, JsonOptions::None), 200);
    }


    /**
     * POST : api/ingredients
     * Store a newly created ingredient in the database.
     */
    public function add(IngredientRequest $request)
    {
        $request->validate();

        $item = Ingredient::create($request->all());
        
        return JsonResponse::success($item, 201);
    }

    /**
     * PUT : api/ingredients/{id}
     * Update the specified ingredient in the database.
     */
    public function update(IngredientRequest $request, $id)
    {
        $request->validate();

        $item = Ingredient::find($id);

        if (!$item) {
            return JsonResponse::error(self::INGREDIENT_NOT_FOUND_MESSAGE, 404);
        }

        $item->update($request->all());
        
        return JsonResponse::success($item, 200);
    }

    /**
     * DELETE : api/ingredients/{id}
     * Remove the specified ingredient from the database.
     */
    public function delete($id)
    {
        $item = Ingredient::find($id);

        if (!$item) {
            return JsonResponse::error(self::INGREDIENT_NOT_FOUND_MESSAGE, 404);
        }

        $item->delete();

        return JsonResponse::success(null, 204);
    }

    public function __construct(JsonConverter $jsonConverter)
    {
        parent::__construct($jsonConverter);
    }
}