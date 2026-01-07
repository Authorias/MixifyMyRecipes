<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Api\Converters\JsonModelConverter;
use App\Http\Controllers\Api\Converters\DefaultJsonModelConverter;


abstract class ApiController extends Controller {
    private JsonModelConverter $jsonConverter;

    protected function getConverter() : JsonModelConverter {
        return $this->jsonConverter;
    }

    public function __construct(?JsonModelConverter $jsonConverter = null) {
        $this->jsonConverter = $jsonConverter ?? new DefaultJsonModelConverter();
    }
}