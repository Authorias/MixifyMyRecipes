<?php

namespace App\Repositories;

interface IWriteRepository extends IRepository
{
    function create($data);
    
    function update(array $primaryKeys, $data);
    
    function delete(array $primaryKeys);
}