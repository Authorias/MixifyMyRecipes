<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Api\Converters\IngredientTypeJsonModelConverter as JsonConverter;
use App\Http\Controllers\Api\Converters\JsonModelConverterOptions as JsonOptions;
use App\Http\Requests\IngredientTypeRequest;
use App\Repositories\IIngredientTypeRepository;
use App\Http\Controllers\Api\ApiError;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\JsonResponse;

class IngredientTypeController extends ApiController {
    private IIngredientTypeRepository $ingredientTypeRepository;

    /**
     * GET : api/ingredienttypes
     * Get a listing of ingredient types.
     */
    public function index() {
        $items = [];

        foreach ($this->ingredientTypeRepository->getAll() as $ingredientType) {
            $items[] = $this->getConverter()->convert($ingredientType, JsonOptions::None);
        }

        return JsonResponse::success($items);
    }

    /**
     * GET : api/ingredienttypes/{id}
     * Get a single ingredient type by ID.
     */
    public function get($id) {
        $item = $this->ingredientTypeRepository->getById([$id]);

        return !$item
            ? JsonResponse::error(ApiError::INGREDIENT_TYPE_NOT_FOUND_MESSAGE, Response::HTTP_NOT_FOUND)
            : JsonResponse::success($this->getConverter()->convert($item, JsonOptions::None), Response::HTTP_OK);
    }

    /**
     * POST : api/ingredienttypes
     * Store a newly created ingredient in the database.
     */
    public function add(IngredientTypeRequest $request) {
        $request->validate();

        $item = $this->ingredientTypeRepository->create($request->all());
        
        return JsonResponse::success($item, 201);
    }

    /**
     * PUT : api/ingredienttypes/{id}
     * Update the specified ingredient type in the database.
     */
    public function update(IngredientTypeRequest $request, $id) {
        $request->validate();

        $item = $this->ingredientTypeRepository->update([$id], $request->all());

        return $item === null
            ? JsonResponse::error(ApiError::INGREDIENT_TYPE_NOT_FOUND_MESSAGE, Response::HTTP_NOT_FOUND)
            : JsonResponse::success($item, Response::HTTP_OK);
    }

    /**
     * DELETE : api/ingredienttypes/{id}
     * Remove the specified ingredient type from the database.
     */
    public function delete($id) {
        $item = $this->ingredientTypeRepository->getById([$id]);

        if (!$item) {
            return JsonResponse::error(ApiError::INGREDIENT_TYPE_NOT_FOUND_MESSAGE, Response::HTTP_NOT_FOUND);
        }

        if ($item->ingredients()->count() > 0) {
            return JsonResponse::error('Unable to delete ingredient type because it is still linked to ingredients.', Response::HTTP_BAD_REQUEST);
        }

        return $this->ingredientTypeRepository->delete($item)
            ? JsonResponse::success(null, Response::HTTP_OK)
            : JsonResponse::error(ApiError::INGREDIENT_TYPE_UNABLE_TO_DELETE_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function __construct(JsonConverter $jsonConverter, IIngredientTypeRepository $ingredientTypeRepository) {
        parent::__construct($jsonConverter);
 
        $this->ingredientTypeRepository = $ingredientTypeRepository;
    }
}