<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Api\Converters\IngredientJsonModelConverter as JsonConverter;
use App\Http\Controllers\Api\Converters\JsonModelConverterOptions as JsonOptions;
use App\Http\Requests\IngredientRequest;
use App\Repositories\IIngredientRepository;
use App\Http\Controllers\Api\ApiError;
use App\Http\Controllers\Api\ApiController;

class IngredientController extends ApiController {

    private IIngredientRepository $ingredientRepository;

    /**
     * GET : api/ingredients
     * Get a listing of ingredients.
     */
    public function index() {
        $items = [];

        foreach ($this->ingredientRepository->getAll() as $ingredient) {
            $items[] = $this->getConverter()->convert($ingredient, JsonOptions::None);
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
            ? JsonResponse::error(ApiError::INGREDIENT_NOT_FOUND_MESSAGE, Response::HTTP_NOT_FOUND)
            : JsonResponse::success($this->getConverter()->convert($item, JsonOptions::None), Response::HTTP_OK);
    }


    /**
     * POST : api/ingredients
     * Store a newly created ingredient in the database.
     */
    public function add(IngredientRequest $request) {
        $request->validate();

        $item = $this->ingredientRepository->create($request->all());
        
        return JsonResponse::success($item, Response::HTTP_OK);
    }

    /**
     * PUT : api/ingredients/{id}
     * Update the specified ingredient in the database.
     */
    public function update(IngredientRequest $request, $id) {
        $request->validate();

        $item = $this->ingredientRepository->update([$id], $request->all());

        return $item === null
            ? JsonResponse::error(ApiError::INGREDIENT_NOT_FOUND_MESSAGE, Response::HTTP_NOT_FOUND)
            : JsonResponse::success($item, Response::HTTP_OK);
    }

    /**
     * DELETE : api/ingredients/{id}
     * Remove the specified ingredient from the database.
     */
    public function delete($id) {
        return $this->ingredientRepository->delete([$id])
            ? JsonResponse::success(null, Response::HTTP_OK)
            : JsonResponse::error(ApiError::INGREDIENT_UNABLE_TO_DELETE_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function __construct(JsonConverter $jsonConverter, IIngredientRepository $ingredientRepository) {
        parent::__construct($jsonConverter);
 
        $this->ingredientRepository = $ingredientRepository;
    }
}