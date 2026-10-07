<?php

namespace Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** Runs a sequence of table migrations as one Laravel migration. */
class TableMigrations extends Migration {
    /** @var TableMigration[] Table migrations to run in order. */
    private array $migrations;

    /**
     * Run each table migration in the configured order.
     */
    public function up(): void
    {
        foreach ($this->migrations as $migration) {
            Schema::create($migration->tablename, function (Blueprint $table) use ($migration) {
                $migration->createSchema($table);
            });
        }
    }

    /**
        * Reverse each table migration in the configured order.
     */
    public function down(): void
    {
        foreach ($this->migrations as $migration) {
            $migration->dropSchema();
        }
    }

    /**
     * Set the table migrations that this migration will run.
     *
     * @param TableMigration[] $tableMigrations Table migrations to execute in order.
     */
    protected function __construct(array $tableMigrations)
    {
        $this->migrations = $tableMigrations;
    }
};