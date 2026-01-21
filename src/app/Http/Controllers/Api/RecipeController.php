<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Api\Converters\RecipeJsonModelConverter as JsonConverter;
use App\Http\Controllers\Api\Converters\JsonModelConverterOptions as JsonOptions;
use App\Http\Requests\RecipeRequest;
use App\Http\Requests\RecipeIngredientRequest;
use App\Repositories\IRecipeRepository;
use App\Repositories\IRecipeIngredientRepository;
use App\Http\Controllers\Api\ApiError;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\JsonResponse;

class RecipeController extends ApiController {
    private IRecipeRepository $recipeRepository;
    private IRecipeIngredientRepository $recipeIngredientRepository;

    /**
     * GET : api/recipes
     * Get a listing of recipes.
     */
    public function index() {
        $items = [];

        foreach ($this->recipeRepository->getAll() as $recipe) {
            $items[] = $this->getConverter()->convert($recipe, JsonOptions::None);
        }

        return JsonResponse::success($items);
    }

    /**
     * GET : api/recipes/{id}
     * Get a single recipe by ID.
     */
    public function get($id) {
        $item = $this->recipeRepository->getById([$id]);

        if (is_null($item)) {
            return JsonResponse::error(ApiError::RECIPE_NOT_FOUND_MESSAGE, Response::HTTP_NOT_FOUND);
        }
        
        $result = $this->getConverter()->convert($item, JsonOptions::Ingredients);

        return JsonResponse::success($result);
    }

    /**
     * POST : api/recipes
     * Store a newly created recipe in the database.
     */
    public function add(RecipeRequest $request) {
        $request->validate();

        $item = $this->recipeRepository->create($request->all());
        
        return JsonResponse::success($item);
    }

    /**
     * PUT : api/recipes/{id}
     * Update the specified recipe in the database.
     */
    public function update(RecipeRequest $request, $id) {
        $request->validate();

        $item = $this->recipeRepository->update([$id], $request->all());

        return is_null($item)
            ? JsonResponse::error(ApiError::RECIPE_NOT_FOUND_MESSAGE, Response::HTTP_NOT_FOUND)
            : JsonResponse::success($item);
    }

    /**
     * DELETE : api/recipes/{id}
     * Remove the specified recipe from the database.
     */
    public function delete($id) {
        return $this->recipeRepository->delete([$id])
            ? JsonResponse::success(null)
            : JsonResponse::error(ApiError::RECIPE_UNABLE_TO_DELETE_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function addIngredient(RecipeIngredientRequest $request, string $recipeid) {
        $request->validate();

        $recipe = $this->recipeRepository->getById([$recipeid]);

        if (is_null($recipe)) {
            return JsonResponse::error(ApiError::RECIPE_NOT_FOUND_MESSAGE, Response::HTTP_NOT_FOUND);
        }

        $data = $request->all();
        $data['recipeid'] = $recipeid;

        $item =  $this->recipeIngredientRepository->create($data);
        
        return JsonResponse::success($item);
    }

    public function updateIngredient(RecipeIngredientRequest $request, string $recipeid) {
        $request->validate();

        $data = $request->all();
        $data['recipeid'] = $recipeid;

        $item = $this->recipeIngredientRepository->update(
            [$recipeid, $request->input('ingredientid')],
            $data
        );
        
        return JsonResponse::success($item);
    }

    public function deleteIngredient(string $recipeid, string $ingredientid) {
        return $this->recipeIngredientRepository->delete([$recipeid, $ingredientid])
            ? JsonResponse::success(null)
            : JsonResponse::error(ApiError::INGREDIENT_UNABLE_TO_DELETE_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function __construct(JsonConverter $jsonConverter, IRecipeRepository $recipeRepository, IRecipeIngredientRepository $recipeIngredientRepository) {
        parent::__construct($jsonConverter);

        $this->recipeRepository = $recipeRepository;
        $this->recipeIngredientRepository = $recipeIngredientRepository;
    }
}