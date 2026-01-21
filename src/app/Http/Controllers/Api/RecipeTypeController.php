<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Api\Converters\RecipeTypeJsonModelConverter as JsonConverter;
use App\Http\Controllers\Api\Converters\JsonModelConverterOptions as JsonOptions;
use App\Http\Requests\RecipeTypeRequest;
use App\Repositories\IRecipeTypeRepository;
use App\Http\Controllers\Api\ApiError;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\JsonResponse;

class RecipeTypeController extends ApiController {
    private IRecipeTypeRepository $recipeTypeRepository;

    /**
     * GET : api/recipetypes
     * Get a listing of recipe types.
     */
    public function index() {
        $items = [];

        foreach ($this->recipeTypeRepository->getAll() as $recipeType) {
            $items[] = $this->getConverter()->convert($recipeType, JsonOptions::None);
        }

        return JsonResponse::success($items);
    }

    /**
     * GET : api/recipetypes/{id}
     * Get a single recipe type by ID.
     */
    public function get($id) {
        $item = $this->recipeTypeRepository->getById([$id]);

        return is_null($item)
            ? JsonResponse::error(ApiError::RECIPE_TYPE_NOT_FOUND_MESSAGE, Response::HTTP_NOT_FOUND)
            : JsonResponse::success($this->getConverter()->convert($item, JsonOptions::None));
    }


    /**
     * POST : api/recipetypes
     * Store a newly created recipe type in the database.
     */
    public function add(RecipeTypeRequest $request) {
        $request->validate();

        $item = $this->recipeTypeRepository->create($request->all());
        
        return JsonResponse::success($item);
    }

    /**
     * PUT : api/recipetypes/{id}
     * Update the specified recipe type in the database.
     */
    public function update(RecipeTypeRequest $request, $id) {
        $request->validate();

        $item = $this->recipeTypeRepository->update([$id], $request->all());

        return is_null($item)
            ? JsonResponse::error(ApiError::RECIPE_TYPE_NOT_FOUND_MESSAGE, Response::HTTP_NOT_FOUND)
            : JsonResponse::success($item);
    }

    /**
     * DELETE : api/recipetypes/{id}
     * Remove the specified recipe type from the database.
     */
    public function delete($id) {
        $item = $this->recipeTypeRepository->getById([$id]);

        if (is_null($item)) {
            return JsonResponse::error(ApiError::RECIPE_TYPE_NOT_FOUND_MESSAGE, Response::HTTP_NOT_FOUND);
        }

        if ($item->recipes()->count() > 0) {
            return JsonResponse::error('Unable to delete recipe type because it is still linked to recipes.', Response::HTTP_BAD_REQUEST);
        }

        return $this->recipeTypeRepository->delete($item)
            ? JsonResponse::success(null)
            : JsonResponse::error(ApiError::RECIPE_TYPE_UNABLE_TO_DELETE_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function __construct(JsonConverter $jsonConverter, IRecipeTypeRepository $recipeTypeRepository) {
        parent::__construct($jsonConverter);

        $this->recipeTypeRepository = $recipeTypeRepository;
    }
}