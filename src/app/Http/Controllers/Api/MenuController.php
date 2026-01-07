<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Api\Converters\MenuJsonModelConverter as JsonConverter;
use App\Http\Controllers\Api\Converters\JsonModelConverterOptions as JsonOptions;
use App\Http\Requests\MenuRequest;
use App\Http\Requests\MenuRecipeRequest;
use App\Repositories\IMenuRepository;
use App\Repositories\IMenuRecipeRepository;
use App\Http\Controllers\Api\ApiError;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\JsonResponse;

class MenuController extends ApiController {
    private IMenuRepository $menuRepository;
    private IMenuRecipeRepository $menuRecipeRepository;

    /**
     * GET : api/menus
     * Get a listing of menus.
     */
    public function index() {
        $items = [];

        foreach ($this->menuRepository->getAll() as $menu) {
            $items[] = $this->getConverter()->convert($menu, JsonOptions::None);
        }

        return JsonResponse::success($items);
    }

    /**
     * GET : api/menus/{id}
     * Get a single menu by ID.
     */
    public function get($id) {
        $item = $this->menuRepository->getById([$id]);

        if (!$item) {
            return JsonResponse::error(ApiError::MENU_NOT_FOUND_MESSAGE, Response::HTTP_NOT_FOUND);
        }
        
        $result = $this->getConverter()->convert($item, JsonOptions::Recipes + JsonOptions::Ingredients);

        return JsonResponse::success($result, Response::HTTP_OK);
    }

    /**
     * POST : api/menus
     * Store a newly created menu in the database.
     */
    public function add(MenuRequest $request) {
        $request->validate();

        $item = $this->menuRepository->create($request->all());
        
        return JsonResponse::success($item, Response::HTTP_OK);
    }

    /**
     * PUT : api/menus/{id}
     * Update the specified menu in the database.
     */
    public function update(MenuRequest $request, $id) {
        $request->validate();

        $item = $this->menuRepository->update([$id], $request->all());

        return $item === null
            ? JsonResponse::error(ApiError::MENU_NOT_FOUND_MESSAGE, Response::HTTP_NOT_FOUND)
            : JsonResponse::success($item, Response::HTTP_OK);
    }

    /**
     * DELETE : api/menus/{id}
     * Remove the specified menu from the database.
     */
    public function delete($id) {
        return $this->menuRepository->delete([$id])
            ? JsonResponse::success(null, Response::HTTP_OK)
            : JsonResponse::error(ApiError::MENU_UNABLE_TO_DELETE_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function addRecipe(MenuRecipeRequest $request, $menuid) {
        $request->validate();

        $menu = $this->menuRepository->getById([$menuid]);

        if ($menu === null) {
            return JsonResponse::error(ApiError::MENU_NOT_FOUND_MESSAGE, Response::HTTP_NOT_FOUND);
        }

        $data = $request->all();
        $data['menuid'] = $menuid;

        $item = $this->menuRecipeRepository->create($data);
        
        return JsonResponse::success($item, Response::HTTP_OK);
    }

    /**
     * Update the specified recipe in the menu.
     *
     * @param  \App\Http\Requests\MenuRecipeRequest  $request
     * @param  string  $id  The recipe ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRecipe(MenuRecipeRequest $request, $menuid) {
        $request->validate();

        $data = $request->all();
        $data['menuid'] = $menuid;

        $item = $this->menuRecipeRepository->update(
            [$menuid, $request->input('recipeid')],
            $data
        );
        
        return JsonResponse::success($item, 200);
    }

    public function deleteRecipe(string $menuid, string $recipeid) {
        return $this->menuRecipeRepository->delete([$menuid, $recipeid])
            ? JsonResponse::success(null, Response::HTTP_OK)
            : JsonResponse::error(ApiError::RECIPE_UNABLE_TO_DELETE_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function __construct(JsonConverter $jsonConverter, IMenuRepository $menuRepository, IMenuRecipeRepository $menuRecipeRepository) {
        parent::__construct($jsonConverter);
        
        $this->menuRepository = $menuRepository;
        $this->menuRecipeRepository = $menuRecipeRepository;
    }
}