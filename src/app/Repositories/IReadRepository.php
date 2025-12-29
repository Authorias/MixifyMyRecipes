<?php

namespace App\Repositories;

interface IReadRepository extends IRepository
{
    function readAll(): array;
    
    function readById(array $primaryKeys): ?object;
}