<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Converters\UnitJsonModelConverter as JsonConverter;
use App\Http\Controllers\Api\Converters\JsonModelConverterOptions as JsonOptions;
use App\Http\Requests\UnitRequest;
use App\Repositories\IUnitRepository;

class UnitController extends ApiController {
    const UNIT_NOT_FOUND_MESSAGE = 'Unit niet gevonden.';

    private IUnitRepository $unitRepository;

    /**
     * GET : api/units
     * Get a listing of units.
     */
    public function index()
    {
        $items = [];

        foreach ($this->unitRepository->getAll() as $unit) {
            $items[] = $this->jsonConverter->convert($unit, JsonOptions::None);
        }

        return JsonResponse::success($items);
    }

    /**
     * GET : api/units/{id}
     * Get a single unit by ID.
     */
    public function get($id) {
        $item = $this->unitRepository->getById([$id]);

        return !$item
            ? JsonResponse::error(self::UNIT_NOT_FOUND_MESSAGE, 404)
            : JsonResponse::success($this->jsonConverter->convert($item, JsonOptions::None), 200);
    }


    /**
     * POST : api/units
     * Store a newly created unit in the database.
     */
    public function add(UnitRequest $request) {
        $request->validate();

        $item = $this->unitRepository->create($request->all());
        
        return JsonResponse::success($item, 201);
    }

    /**
     * PUT : api/units/{id}
     * Update the specified unit in the database.
     */
    public function update(UnitRequest $request, $id) {
        $request->validate();

        $item = $this->unitRepository->getById([$id]);

        if (!$item) {
            return JsonResponse::error(self::UNIT_NOT_FOUND_MESSAGE, 404);
        }

        $item->update($request->all());
        
        return JsonResponse::success($item, 200);
    }

    /**
     * DELETE : api/units/{id}
     * Remove the specified unit from the database.
     */
    public function delete($id) {
        $item = $this->unitRepository->getById([$id]);

        if (!$item) {
            return JsonResponse::error(self::UNIT_NOT_FOUND_MESSAGE, 404);
        }

        if ($item->ingredientRecipes()->count() > 0) {
            return JsonResponse::error('Kan deze eenheid niet verwijderen omdat er nog ingredienten in recepten aan gekoppeld zijn.', 400);
        }

        $item->delete();

        return JsonResponse::success(null, 204);
    }

    public function __construct(JsonConverter $jsonConverter, IUnitRepository $unitRepository) {
        parent::__construct($jsonConverter);

        $this->unitRepository = $unitRepository;
    }
}