<?php

namespace App\Repositories;

abstract class Repository implements IRepository, IReadWriteRepository
{
    protected function getValueFromPrimaryKeys(array $primaryKeys, int $index)
    {
        $keys = array_values($primaryKeys);
        $count = count($keys);

        return $index < 0 || $index >= $count
            ? throw new \InvalidArgumentException("Index $index is out of bounds for primary keys array of size $count.")
            : $keys[$index];
    }
}