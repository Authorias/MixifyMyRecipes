<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\IngredientTypeRequest;
use App\Models\IngredientType;

use App\Http\Controllers\Api\Converters\IngredientTypeJsonModelConverter as JsonConverter;
use App\Http\Controllers\Api\Converters\JsonModelConverterOptions as JsonOptions;

class IngredientTypeController extends ApiController
{
    const INGREDIENT_TYPE_NOT_FOUND_MESSAGE = 'Ingredient type niet gevonden.';

    /**
     * GET : api/ingredienttypes
     * Get a listing of ingredient types.
     */
    public function index()
    {
        $items = [];

        foreach (IngredientType::all() as $ingredientType) {
            $items[] = $this->jsonConverter->convert($ingredientType, JsonOptions::None);
        }

        return JsonResponse::success($items);
    }

    /**
     * GET : api/ingredienttypes/{id}
     * Get a single ingredient type by ID.
     */
    public function get($id)
    {
        $item = IngredientType::find($id);

        return !$item
            ? JsonResponse::error(self::INGREDIENT_TYPE_NOT_FOUND_MESSAGE, 404)
            : JsonResponse::success($this->jsonConverter->convert($item, JsonOptions::None), 200);
    }

    /**
     * POST : api/ingredienttypes
     * Store a newly created ingredient in the database.
     */
    public function add(IngredientTypeRequest $request)
    {
        $request->validate();

        $item = IngredientType::create($request->all());
        
        return JsonResponse::success($item, 201);
    }

    /**
     * PUT : api/ingredienttypes/{id}
     * Update the specified ingredient type in the database.
     */
    public function update(IngredientTypeRequest $request, $id)
    {
        $request->validate();

        $item = IngredientType::find($id);

        if (!$item) {
            return JsonResponse::error(self::INGREDIENT_TYPE_NOT_FOUND_MESSAGE, 404);
        }

        $item->update($request->all());

        return JsonResponse::success($item, 200);
    }

    /**
     * DELETE : api/ingredienttypes/{id}
     * Remove the specified ingredient type from the database.
     */
    public function delete($id)
    {
        $item = IngredientType::find($id);

        if (!$item) {
            return JsonResponse::error(self::INGREDIENT_TYPE_NOT_FOUND_MESSAGE, 404);
        }

        if ($item->ingredients()->count() > 0) {
            return JsonResponse::error('Kan dit ingredient type niet verwijderen omdat er nog ingredienten aan gekoppeld zijn.', 400);
        }

        $item->delete();

        return JsonResponse::success(null, 204);
    }

    public function __construct(JsonConverter $jsonConverter)
    {
        parent::__construct($jsonConverter);
    }
}