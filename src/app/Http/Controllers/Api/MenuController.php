<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\MenuRequest;
use App\Http\Requests\RecipeMenuRequest;
use App\Models\Menu;
use App\Models\RecipeMenu;

use App\Http\Controllers\Api\Converters\MenuJsonModelConverter as JsonConverter;
use App\Http\Controllers\Api\Converters\JsonModelConverterOptions as JsonOptions;

class MenuController extends ApiController
{
    const MENU_NOT_FOUND_MESSAGE = 'Menu niet gevonden.';

    /**
     * GET : api/menus
     * Get a listing of menus.
     */
    public function index()
    {
        $items = [];

        foreach (Menu::all() as $menu) {
            $items[] = $this->jsonConverter->convert($menu, JsonOptions::None);
        }

        return JsonResponse::success($items);
    }

    /**
     * GET : api/menus/{id}
     * Get a single menu by ID.
     */
    public function get($id)
    {
        $item = Menu::find($id);

        if (!$item) {
            return JsonResponse::error(self::MENU_NOT_FOUND_MESSAGE, 404);
        }
        
        $result = $this->jsonConverter->convert($item, JsonOptions::Recipes + JsonOptions::Ingredients);

        return JsonResponse::success($result, 200);
    }

    /**
     * POST : api/menus
     * Store a newly created menu in the database.
     */
    public function add(MenuRequest $request)
    {
        $request->validate();

        $item = Menu::create($request->all());
        
        return JsonResponse::success($item, 201);
    }

    /**
     * PUT : api/menus/{id}
     * Update the specified menu in the database.
     */
    public function update(MenuRequest $request, $id)
    {
        $request->validate();

        $item = Menu::find($id);

        if (!$item) {
            return JsonResponse::error(self::MENU_NOT_FOUND_MESSAGE, 404);
        }

        $item->update($request->all());
        
        return JsonResponse::success($item, 200);
    }

    /**
     * DELETE : api/menus/{id}
     * Remove the specified menu from the database.
     */
    public function delete($id)
    {
        $item = Menu::find($id);

        if (!$item) {
            return JsonResponse::error(self::MENU_NOT_FOUND_MESSAGE, 404);
        }

        $item->delete();

        return JsonResponse::success(null, 204);
    }

    public function getRecipes(string $menuid)
    {
        $menu = Menu::find($menuid);

        if (!$menu) {
            return JsonResponse::error(self::MENU_NOT_FOUND_MESSAGE, 404);
        }

        $item = RecipeMenu::where('menuid', $menuid)->orderBy('position')->get();
        
        return JsonResponse::success($item, 200);
    }

    public function addRecipe(RecipeMenuRequest $request, $menuid)
    {
        $request->validate();

        $menu = Menu::find($menuid);

        if (!$menu) {
            return JsonResponse::error(self::MENU_NOT_FOUND_MESSAGE, 404);
        }

        $data = $request->all();
        $data['menuid'] = $menuid;

        $item = RecipeMenu::create($data);
        
        return JsonResponse::success($item, 200);
    }

    /**
     * Update the specified recipe in the menu.
     *
     * @param  \App\Http\Requests\RecipeMenuRequest  $request
     * @param  string  $id  The recipe ID
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRecipe(RecipeMenuRequest $request, $id)
    {
        $request->validate();

        $item = RecipeMenu::where('menuid', $id)
            ->where('recipeid', $request->input('recipeid'))
            ->first();

        if (!$item) {
            return JsonResponse::error('Recipe niet gevonden in menu.', 404);
        }

        $item->update($request->all());
        
        return JsonResponse::success($item, 200);
    }

    public function deleteRecipe(string $menuid, string $recipeid)
    {
        $item = RecipeMenu::where('menuid', $menuid)
            ->where('recipeid', $recipeid)
            ->first();

        if ($item) 
        {
            $item->delete();
        }
        
        return JsonResponse::success(null, 204);
    }

    private function loadRecipes($menuid)
    {
         $result = [];

        foreach (RecipeMenu::where('menuid', $menuid)->get() as $item)
        {
            $result[] = [
                'id' => $item->recipeid, 
                'name' => $item->recipe->name,
                'tags' => $item->recipe->tags,
                'position' => $item->position,
                'numberofpeople' => $item->recipe->numberofpeople,
                'type' => [
                    'id' => $item->recipe->typeid, 
                    'name' => $item->recipe->type->name
                ]
            ];
        }
        
        return $result;
   }

    public function __construct(JsonConverter $jsonConverter)
    {
        parent::__construct($jsonConverter);
    }
}