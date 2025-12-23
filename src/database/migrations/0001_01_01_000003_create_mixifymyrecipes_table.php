<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ForeignKeyDefinition;

return new class extends Migration
{
    const UNITS_TABLE_NAME = 'units';
    const INGREDIENTS_TABLE_NAME = 'ingredients';
    const INGREDIENTTYPES_TABLE_NAME = 'ingredienttypes';
    const RECIPES_TABLE_NAME = 'recipes';
    const RECIPETYPES_TABLE_NAME = 'recipetypes';
    const RECIPE_INGREDIENTS_TABLE_NAME = 'recipeingredients';
    const MENUS_TABLE_NAME = 'menus';
    const MENU_RECIPES_TABLE_NAME = 'menurecipes';

    const NAME_COLUMN_LENGTH = 100;
    const TAGS_COLUMN_LENGTH = 500;

    const FOREIGN_KEY_PREFIX = 'fk_';
    const UNIQUE_INDEX_PREFIX = 'idx_unique_';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(self::UNITS_TABLE_NAME, function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name', length: self::NAME_COLUMN_LENGTH)->unique(self::UNIQUE_INDEX_PREFIX . 'name')->nullable(false);
            $table->string('abbreviation', length: 10)->unique(self::UNIQUE_INDEX_PREFIX . 'abbreviation')->nullable(false);
            $table->timestamps();
        });        

        Schema::create(self::INGREDIENTTYPES_TABLE_NAME, function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name', length: self::NAME_COLUMN_LENGTH)->unique(self::UNIQUE_INDEX_PREFIX . 'name')->nullable(false);
            $table->timestamps();
        });        

        Schema::create(self::INGREDIENTS_TABLE_NAME, function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name', length: self::NAME_COLUMN_LENGTH)->unique(self::UNIQUE_INDEX_PREFIX . 'name')->nullable(false);
            
            self::buildForeignKey(
                $table, 
                'ingredienttypeid', 
                self::INGREDIENTS_TABLE_NAME, 
                self::INGREDIENTTYPES_TABLE_NAME,
                nullable: true
            )->onDelete('set null');

            $table->timestamps();
        });

        Schema::create(self::RECIPETYPES_TABLE_NAME, function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name', length: self::NAME_COLUMN_LENGTH)->unique(self::UNIQUE_INDEX_PREFIX . 'name')->nullable(false);
            $table->timestamps();
        });        

        Schema::create(self::RECIPES_TABLE_NAME, function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name', length: self::NAME_COLUMN_LENGTH)->unique(self::UNIQUE_INDEX_PREFIX . 'name')->nullable(false);
            $table->string('tags', length: self::TAGS_COLUMN_LENGTH);

            self::buildForeignKey(
                $table,
                'recipetypeid',
                self::RECIPES_TABLE_NAME,
                self::RECIPETYPES_TABLE_NAME,
                nullable: true
            )->onDelete('set null');

            $table->unsignedInteger('numberofpeople');
            $table->text('preparation');
            $table->time('preparationtime', precision: 0)->nullable();
            $table->unsignedBigInteger('createdby')->nullable();
            $table->timestamps();
        });

        Schema::create(self::RECIPE_INGREDIENTS_TABLE_NAME, function (Blueprint $table) {
            self::buildForeignKey(
                $table,
                'recipeid',
                self::RECIPE_INGREDIENTS_TABLE_NAME,
                self::RECIPES_TABLE_NAME
            )->onDelete('cascade');
            
            self::buildForeignKey(
                $table,
                'ingredientid',
                self::RECIPE_INGREDIENTS_TABLE_NAME,
                self::INGREDIENTS_TABLE_NAME
            )->onDelete('cascade');

            self::buildForeignKey(
                $table, 
                'unitid',
                self::RECIPE_INGREDIENTS_TABLE_NAME,
                self::UNITS_TABLE_NAME,
                nullable: true
            )->onDelete('set null');

            $table->float('quantity', precision: 2);
            $table->timestamps();

            $table->primary(['recipeid', 'ingredientid']);
        });

        Schema::create(self::MENUS_TABLE_NAME, function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name', length: self::NAME_COLUMN_LENGTH)->unique(self::UNIQUE_INDEX_PREFIX . 'name')->nullable(false);
            $table->string('tags', length: self::TAGS_COLUMN_LENGTH);
            $table->unsignedBigInteger('createdby')->nullable();
            $table->timestamps();
        });

        Schema::create(self::MENU_RECIPES_TABLE_NAME, function (Blueprint $table) {
            self::buildForeignKey(
                $table, 
                'menuid',
                self::MENU_RECIPES_TABLE_NAME,
                self::MENUS_TABLE_NAME
            )->onDelete('cascade');
            
            self::buildForeignKey(
                $table, 
                'recipeid',
                self::MENU_RECIPES_TABLE_NAME,
                self::RECIPES_TABLE_NAME
            )->onDelete('cascade');

            $table->unsignedInteger('position');
            $table->timestamps();

            $table->primary(['menuid', 'recipeid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(self::MENU_RECIPES_TABLE_NAME);
        Schema::dropIfExists(self::MENUS_TABLE_NAME);
        Schema::dropIfExists(self::RECIPE_INGREDIENTS_TABLE_NAME);
        Schema::dropIfExists(self::RECIPES_TABLE_NAME);
        Schema::dropIfExists(self::RECIPETYPES_TABLE_NAME);
        Schema::dropIfExists(self::INGREDIENTS_TABLE_NAME);
        Schema::dropIfExists(self::INGREDIENTTYPES_TABLE_NAME);
        Schema::dropIfExists(self::UNITS_TABLE_NAME);
    }

    private static function buildForeignKey(Blueprint $table, string $columnName, string $sourceTableName, string $targetTableName, string $targetColumnName = 'id', bool $nullable = false): ForeignKeyDefinition
    {
        $column = $table->unsignedBigInteger($columnName);

        if ($nullable) 
        {
            $column->nullable();
        }

        return $table->foreign($columnName, self::FOREIGN_KEY_PREFIX . $sourceTableName . '_' . $targetTableName)
            ->references($targetColumnName)
            ->on($targetTableName);
    }
};