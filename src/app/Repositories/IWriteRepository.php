<?php

namespace App\Repositories;

interface IWriteRepository
{
    function create($data);
    
    function update($id, $data);
    
    function delete($id);
}