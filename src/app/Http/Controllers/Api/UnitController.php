<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Api\Converters\UnitJsonModelConverter as JsonConverter;
use App\Http\Controllers\Api\Converters\JsonModelConverterOptions as JsonOptions;
use App\Http\Requests\UnitRequest;
use App\Repositories\IUnitRepository;
use App\Http\Controllers\Api\ApiError;
use App\Http\Controllers\Api\ApiController;

class UnitController extends ApiController {
    private IUnitRepository $unitRepository;

    /**
     * GET : api/units
     * Get a listing of units.
     */
    public function index()
    {
        $items = [];

        foreach ($this->unitRepository->getAll() as $unit) {
            $items[] = $this->getConverter()->convert($unit, JsonOptions::None);
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
            ? JsonResponse::error(ApiError::UNIT_NOT_FOUND_MESSAGE, Response::HTTP_NOT_FOUND)
            : JsonResponse::success($this->getConverter()->convert($item, JsonOptions::None), Response::HTTP_OK);
    }


    /**
     * POST : api/units
     * Store a newly created unit in the database.
     */
    public function add(UnitRequest $request) {
        $request->validate();

        $item = $this->unitRepository->create($request->all());
        
        return JsonResponse::success($item, Response::HTTP_OK);
    }

    /**
     * PUT : api/units/{id}
     * Update the specified unit in the database.
     */
    public function update(UnitRequest $request, $id) {
        $request->validate();

        $item = $this->unitRepository->update([$id], $request->all());

        return $item === null
            ? JsonResponse::error(ApiError::UNIT_NOT_FOUND_MESSAGE, Response::HTTP_NOT_FOUND)
            : JsonResponse::success($item, Response::HTTP_OK);
    }

    /**
     * DELETE : api/units/{id}
     * Remove the specified unit from the database.
     */
    public function delete($id) {
        $item = $this->unitRepository->getById([$id]);

        if (!$item) {
            return JsonResponse::error(ApiError::UNIT_NOT_FOUND_MESSAGE, Response::HTTP_NOT_FOUND);
        }

        if ($item->ingredientRecipes()->count() > 0) {
            return JsonResponse::error('Unable to delete unit because it is still linked to ingredients in recipes.', Response::HTTP_BAD_REQUEST);
        }

        return $this->unitRepository->delete([$id])
            ? JsonResponse::success(null, Response::HTTP_OK)
            : JsonResponse::error(ApiError::UNIT_UNABLE_TO_DELETE_MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function __construct(JsonConverter $jsonConverter, IUnitRepository $unitRepository) {
        parent::__construct($jsonConverter);

        $this->unitRepository = $unitRepository;
    }
}