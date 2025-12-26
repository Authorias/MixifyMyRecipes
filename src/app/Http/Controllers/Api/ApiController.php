<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Api\Converters\JsonModelConverter;

class ApiController extends Controller
{
    protected JsonModelConverter $jsonConverter;

    public function __construct(JsonModelConverter $jsonConverter)
    {
        $this->jsonConverter = $jsonConverter;
    }
}