<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\Converters\IngredientJsonModelConverter as JsonConverter;
use App\Http\Controllers\Api\Converters\JsonModelConverterOptions as JsonOptions;
use App\Http\Requests\IngredientRequest;
use App\Repositories\IIngredientRepository;

class IngredientController extends ApiController {
    const INGREDIENT_NOT_FOUND_MESSAGE = 'Ingredient niet gevonden.';

    private IIngredientRepository $ingredientRepository;

    /**
     * GET : api/ingredients
     * Get a listing of ingredients.
     */
    public function index() {
        $items = [];

        foreach ($this->ingredientRepository->getAll() as $ingredient) {
            $items[] = $this->jsonConverter->convert($ingredient, JsonOptions::None);
        }

        return JsonResponse::success($items);
    }

    /**
     * GET : api/ingredients/{id}
     * Get a single ingredient by ID.
     */
    public function get($id) {
        $item = $this->ingredientRepository->getById([$id]);

        return $item === null
            ? JsonResponse::error(self::INGREDIENT_NOT_FOUND_MESSAGE, 404)
            : JsonResponse::success($this->jsonConverter->convert($item, JsonOptions::None), 200);
    }


    /**
     * POST : api/ingredients
     * Store a newly created ingredient in the database.
     */
    public function add(IngredientRequest $request) {
        $request->validate();

        $item = $this->ingredientRepository->create($request->all());
        
        return JsonResponse::success($item, 201);
    }

    /**
     * PUT : api/ingredients/{id}
     * Update the specified ingredient in the database.
     */
    public function update(IngredientRequest $request, $id)
    {
        $request->validate();

        $item = $this->ingredientRepository->getById([$id]);

        if ($item === null) {
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
        $item = $this->ingredientRepository->getById([$id]);

        if ($item === null) {
            return JsonResponse::error(self::INGREDIENT_NOT_FOUND_MESSAGE, 404);
        }

        $item->delete();

        return JsonResponse::success(null, 204);
    }

    public function __construct(JsonConverter $jsonConverter, IIngredientRepository $ingredientRepository)
    {
        parent::__construct($jsonConverter);
        $this->ingredientRepository = $ingredientRepository;
    }
}