<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ForeignKeyDefinition;

function buildForeignKey(Blueprint $table, string $columnName, string $sourceTableName, string $targetTableName, string $targetColumnName = 'id', bool $nullable = false): ForeignKeyDefinition
{
    $column = $table->unsignedBigInteger($columnName);

    if ($nullable) 
    {
        $column->nullable();
    }

    return $table->foreign($columnName, 'fk_' . $sourceTableName . '_' . $targetTableName)
        ->references($targetColumnName)
        ->on($targetTableName);
}