<?php

namespace Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ForeignKeyDefinition;

/** Provides shared schema lifecycle behavior for migrations that manage one table. */
abstract class TableMigration {
    /** Prefix used when naming foreign-key constraints. */
    public const FOREIGN_KEY_PREFIX = 'fk_';

    /** Prefix used when naming unique indexes. */
    public const UNIQUE_INDEX_PREFIX = 'idx_unique_';

    /** Name of the table managed by this migration. */
    public string $tablename;

    /** Define the columns, indexes, and constraints for the managed table. */
    /** @param Blueprint $table Schema builder for the managed table. */
    abstract public function createSchema(Blueprint $table): void;

        /** Drop the managed table if it exists. */
    abstract public function dropSchema(): void;

    /**
     * Add an unsigned big-integer foreign-key column and its constraint.
     *
     * The constraint name is formed from the configured source table and target table.
     * The column is nullable only when requested; referential actions can be chained
     * onto the returned foreign-key definition.
     *
     * @param Blueprint $table Schema builder for the source table.
     * @param string $columnName Name of the foreign-key column to add.
     * @param string $targetTableName Name of the referenced table.
     * @param string $targetColumnName Name of the referenced column; defaults to `id`.
     * @param bool $nullable Whether the foreign-key column may be null.
     * @return ForeignKeyDefinition Definition of the created foreign-key constraint.
     */
    protected function buildForeignKey(Blueprint $table, string $columnName, string $targetTableName, string $targetColumnName = 'id', bool $nullable = false): ForeignKeyDefinition
    {
        $column = $table->unsignedBigInteger($columnName);

        if ($nullable) 
        {
            $column->nullable();
        }

        return $table->foreign($columnName, self::FOREIGN_KEY_PREFIX . $this->tablename . '_' . $targetTableName)
            ->references($targetColumnName)
            ->on($targetTableName);
    }

    /** Set the table name used by the migration's lifecycle and constraint naming. */
    /** @param string $tablename Name of the table managed by this migration. */
    protected function __construct(string $tablename)
    {
        $this->tablename = $tablename;
    }
};