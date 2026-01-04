<?php

namespace App\Http\Controllers\Api;

use App\Models\RecipeIngredient;

use App\Http\Controllers\Api\Converters\RecipeJsonModelConverter as JsonConverter;
use App\Http\Controllers\Api\Converters\JsonModelConverterOptions as JsonOptions;
use App\Http\Requests\RecipeRequest;
use App\Http\Requests\RecipeIngredientRequest;
use App\Repositories\IRecipeRepository;

class RecipeController extends ApiController {
    const RECIPE_NOT_FOUND_MESSAGE = 'Recept niet gevonden.';

    private IRecipeRepository $recipeRepository;

    /**
     * GET : api/recipes
     * Get a listing of recipes.
     */
    public function index() {
        $items = [];

        foreach ($this->recipeRepository->getAll() as $recipe) {
            $items[] = $this->jsonConverter->convert($recipe, JsonOptions::None);
        }

        return JsonResponse::success($items);
    }

    /**
     * GET : api/recipes/{id}
     * Get a single recipe by ID.
     */
    public function get($id) {
        $item = $this->recipeRepository->getById([$id]);

        if (!$item) {
            return JsonResponse::error(self::RECIPE_NOT_FOUND_MESSAGE, 404);
        }
        
        $result = $this->jsonConverter->convert($item, JsonOptions::Ingredients);

        return JsonResponse::success($result, 200);
    }

    /**
     * POST : api/recipes
     * Store a newly created recipe in the database.
     */
    public function add(RecipeRequest $request) {
        $request->validate();

        $item = $this->recipeRepository->create($request->all());
        
        return JsonResponse::success($item, 201);
    }

    /**
     * PUT : api/recipes/{id}
     * Update the specified recipe in the database.
     */
    public function update(RecipeRequest $request, $id) {
        $request->validate();

        $item = $this->recipeRepository->getById([$id]);

        if (!$item) {
            return JsonResponse::error(self::RECIPE_NOT_FOUND_MESSAGE, 404);
        }

        $item->update($request->all());
        
        return JsonResponse::success($item, 200);
    }

    /**
     * DELETE : api/recipes/{id}
     * Remove the specified recipe from the database.
     */
    public function delete($id) {
        $item = $this->recipeRepository->getById([$id]);

        if (!$item) {
            return JsonResponse::error(self::RECIPE_NOT_FOUND_MESSAGE, 404);
        }

        $item->delete();

        return JsonResponse::success(null, 204);
    }

    public function getIngredients(string $recipeid) {

        $recipe = $this->recipeRepository->getById([$recipeid]);

        if (!$recipe) {
            return JsonResponse::error(self::RECIPE_NOT_FOUND_MESSAGE, 404);
        }

        $ingredients = $this->loadIngredients($recipeid);
        
        return JsonResponse::success($ingredients, 200);
    }

    public function addIngredient(RecipeIngredientRequest $request, string $recipeid) {
        $request->validate();

        $recipe = $this->recipeRepository->getById([$recipeid]);

        if (!$recipe) {
            return JsonResponse::error(self::RECIPE_NOT_FOUND_MESSAGE, 404);
        }

        $data = $request->all();
        $data['recipeid'] = $recipeid;

        $item = RecipeIngredient::create($data);
        
        return JsonResponse::success($item, 201);
    }

    public function updateIngredient(RecipeIngredientRequest $request, string $recipeid) {
        $request->validate();

        $recipe = $this->recipeRepository->getById([$recipeid]);
        
        if (!$recipe) {
            return JsonResponse::error(self::RECIPE_NOT_FOUND_MESSAGE, 404);
        }

        $data = $request->all();
        $data['recipeid'] = $recipeid;

        $item = RecipeIngredient::update($data);
        
        return JsonResponse::success($item, 201);
    }

    public function deleteIngredient(string $recipeid, string $ingredientid) {
        $item = RecipeIngredient::where('recipeid', $recipeid)
            ->where('ingredientid', $ingredientid)
            ->first();

        if ($item) 
        {
            $item->delete();
        }
        
        return JsonResponse::success(null, 204);
    }

    private function loadIngredients(string $recipeid) {
         $result = [];

        foreach (RecipeIngredient::where('recipeid', $recipeid)->get() as $item)
        {
            $result[] = [
                'id' => $item->ingredientid, 
                'name' => $item->ingredient->name,
                'quantity' => $item->quantity, 
                'unit' => [
                    'id' => $item->unitid, 
                    'name' => $item->unit->name, 
                    'abbreviation' => $item->unit->abbreviation
                ]
            ];
        }
        
        return $result;
   }

    public function __construct(JsonConverter $jsonConverter, IRecipeRepository $recipeRepository) {
        parent::__construct($jsonConverter);
        $this->recipeRepository = $recipeRepository;
    }
}