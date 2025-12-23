<?php

namespace App\Repositories;

interface IReadRepository
{
    function readAll(): array;
    
    function readById($id): ?object;
}