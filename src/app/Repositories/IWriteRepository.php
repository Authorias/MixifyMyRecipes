<?php

namespace App\Repositories;

interface IWriteRepository {
    function create($data) : ?object;
    
    function update(array $primaryKeys, $data) : ?object;
    
    function delete($item) : bool;
}