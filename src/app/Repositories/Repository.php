<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

abstract class Repository implements IRepository
{
    private string $modelName = '';

    public function create($data) : ?object {
        return $this->getModelName()::create($data);
    }

    public function getAll(int $page = 0, int $limit = 10) : Collection {
        return $page > 0 && $limit > 0
            ? $this->getModelName()::skip(($page - 1) * $limit)->take($limit)->get()
            : $this->getModelName()::all();
    }

    public function getById(array $primaryKeys) : ?object {
        return $this->getModelName()::where('id', $this->getValueFromPrimaryKeys($primaryKeys))->first();
    }

    public function delete($item) : bool {
        return is_array($item)
            ? $this->deleteByPrimaryKeys($item)
            : $this->deleteByObject($item);
    }

    public function update(array $primaryKeys, $data) : ?object {
        $item = $this->getById($primaryKeys);

        if (!is_null($item)) {
            $item->update($data);
        }

        return $item;
    }

    protected function getModelName() : string {
        return $this->modelName;
    }

    protected function getValueFromPrimaryKeys(array $primaryKeys, int $index = 0) {
        $keys = array_values($primaryKeys);
        $count = count($keys);

        return $index < 0 || $index >= $count
            ? throw new \InvalidArgumentException("Index $index is out of bounds for primary keys array of size $count.")
            : $keys[$index];
    }

    private function deleteByObject(object $item) : bool {
        return is_null($item) 
            ? false
            : $item->delete() > 0;
    }

    private function deleteByPrimaryKeys(array $primaryKeys) : bool {
        return $this->deleteByObject($this->getById($primaryKeys));
    }

    public function __construct(string $modelName = '') {
        $this->modelName = is_null($modelName) || $modelName === '' 
            ? throw new \InvalidArgumentException('Model name cannot be null or empty.')
            : $modelName;
    }
}