<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Converters\RecipeTypeJsonModelConverter as JsonConverter;
use App\Http\Controllers\Api\Converters\JsonModelConverterOptions as JsonOptions;
use App\Http\Requests\RecipeTypeRequest;
use App\Repositories\IRecipeTypeRepository;


class RecipeTypeController extends ApiController {
    const RECIPE_TYPE_NOT_FOUND_MESSAGE = 'Recept type niet gevonden.';

    private IRecipeTypeRepository $recipeTypeRepository;

    /**
     * GET : api/recipetypes
     * Get a listing of recipe types.
     */
    public function index() {
        $items = [];

        foreach ($this->recipeTypeRepository->getAll() as $recipeType) {
            $items[] = $this->jsonConverter->convert($recipeType, JsonOptions::None);
        }

        return JsonResponse::success($items);
    }

    /**
     * GET : api/recipetypes/{id}
     * Get a single recipe type by ID.
     */
    public function get($id) {
        $item = $this->recipeTypeRepository->getById([$id]);

        return !$item
            ? JsonResponse::error(self::RECIPE_TYPE_NOT_FOUND_MESSAGE, 404)
            : JsonResponse::success($this->jsonConverter->convert($item, JsonOptions::None), 200);
    }


    /**
     * POST : api/recipetypes
     * Store a newly created recipe type in the database.
     */
    public function add(RecipeTypeRequest $request) {
        $request->validate();

        $item = $this->recipeTypeRepository->create($request->all());
        
        return JsonResponse::success($item, 201);
    }

    /**
     * PUT : api/recipetypes/{id}
     * Update the specified recipe type in the database.
     */
    public function update(RecipeTypeRequest $request, $id) {
        $request->validate();

        $item = $this->recipeTypeRepository->getById([$id]);

        if (!$item) {
            return JsonResponse::error(self::RECIPE_TYPE_NOT_FOUND_MESSAGE, 404);
        }

        $item->update($request->all());

        return JsonResponse::success($item, 200);
    }

    /**
     * DELETE : api/recipetypes/{id}
     * Remove the specified recipe type from the database.
     */
    public function delete($id) {
        $item = $this->recipeTypeRepository->getById([$id]);

        if (!$item) {
            return JsonResponse::error(self::RECIPE_TYPE_NOT_FOUND_MESSAGE, 404);
        }

        if ($item->recipes()->count() > 0) {
            return JsonResponse::error('Kan dit recept type niet verwijderen omdat er nog recepten aan gekoppeld zijn.', 400);
        }

        $item->delete();

        return JsonResponse::success(null, 204);
    }

    public function __construct(JsonConverter $jsonConverter, IRecipeTypeRepository $recipeTypeRepository) {
        parent::__construct($jsonConverter);
        $this->recipeTypeRepository = $recipeTypeRepository;
    }
}