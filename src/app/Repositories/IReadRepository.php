<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface IReadRepository {
    function getAll(int $page = 0, int $limit = 10) : Collection;
    
    function getById(array $primaryKeys) : ?object;
}