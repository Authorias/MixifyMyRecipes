<?php

namespace App\Repositories;

abstract class Repository implements IRepository
{
    private string $modelName = '';

    public function create($data)
    {
        return $this->getModelName()::create($data);
    }

    public function readAll(): array
    {
        return $this->getModelName()::all()->toArray();
    }

    public function delete(array $primaryKeys): bool
    {
        $item = $this->readById($primaryKeys);

        return $item === null
            ? false
            : $item->delete() > 0;
    }

    public function update(array $primaryKeys, $data): ?object
    {
        $item = $this->readById($primaryKeys);

        if ($item != null) 
        {
            $item->update($data);
        }

        return $item;
    }

    protected function getModelName(): string
    {
        return $this->modelName;
    }

    protected function getValueFromPrimaryKeys(array $primaryKeys, int $index = 0)
    {
        $keys = array_values($primaryKeys);
        $count = count($keys);

        return $index < 0 || $index >= $count
            ? throw new \InvalidArgumentException("Index $index is out of bounds for primary keys array of size $count.")
            : $keys[$index];
    }

    public function __construct(string $modelName = '')
    {
        $this->modelName = $modelName ?? '';
    }
}