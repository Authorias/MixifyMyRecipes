<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface IReadRepository {
    function getAll() : Collection;
    
    function getById(array $primaryKeys) : ?object;
}