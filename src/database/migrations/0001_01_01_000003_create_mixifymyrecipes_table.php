<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Database\Migrations\TableMigrations;
use Database\Migrations\MixifyMyRecipiesTableMigration;

/** Creates the units table. */
class UnitsMigration extends MixifyMyRecipiesTableMigration
{
    /** Define the unit name and abbreviation columns. */
    public function createSchema(Blueprint $table): void
    {
        $table->id()->primary();
        $table->string('name', length: self::NAME_COLUMN_LENGTH)->unique(self::UNIQUE_INDEX_PREFIX . 'name')->nullable(false);
        $table->string('abbreviation', length: 10)->unique(self::UNIQUE_INDEX_PREFIX . 'abbreviation')->nullable(false);
        $table->timestamps();
    }

    /** Drop the units table if it exists. */
    public function dropSchema(): void
    {
        Schema::dropIfExists($this->tablename);
    }

    /** Configure this migration to manage the units table. */
    public function __construct()
    {
        parent::__construct(self::UNITS_TABLE_NAME);
    }
};

/** Creates the ingredient types table. */
class IngredientTypesMigration extends MixifyMyRecipiesTableMigration
{
    /** Define the ingredient type name column. */
    public function createSchema(Blueprint $table): void
    {
        $table->id()->primary();
        $table->string('name', length: self::NAME_COLUMN_LENGTH)->unique(self::UNIQUE_INDEX_PREFIX . 'name')->nullable(false);
        $table->timestamps();
    }

    /** Drop the ingredient types table if it exists. */
    public function dropSchema(): void
    {
        Schema::dropIfExists($this->tablename);
    }

    /** Configure this migration to manage the ingredient types table. */
    public function __construct()
    {
        parent::__construct(self::INGREDIENTTYPES_TABLE_NAME);
    }
};

/** Creates the ingredients table. */
class IngredientsMigration extends MixifyMyRecipiesTableMigration
{
    /** Define ingredient names and their optional ingredient type relationship. */
    public function createSchema(Blueprint $table): void
    {
        $table->id()->primary();
        $table->string('name', length: self::NAME_COLUMN_LENGTH)->unique(self::UNIQUE_INDEX_PREFIX . 'name')->nullable(false);
        
        $this->buildForeignKey(
            $table, 
            'ingredienttypeid', 
            self::INGREDIENTTYPES_TABLE_NAME,
            nullable: true
        )->onDelete('set null');

        $table->timestamps();
    }

    /** Drop the ingredients table if it exists. */
    public function dropSchema(): void
    {
        Schema::dropIfExists($this->tablename);
    }

    /** Configure this migration to manage the ingredients table. */
    public function __construct()
    {
        parent::__construct(self::INGREDIENTS_TABLE_NAME);
    }
};

/** Creates the recipe types table. */
class RecipeTypesMigration extends MixifyMyRecipiesTableMigration
{
    /** Define the recipe type name column. */
    public function createSchema(Blueprint $table): void
    {
        $table->id()->primary();
        $table->string('name', length: self::NAME_COLUMN_LENGTH)->unique(self::UNIQUE_INDEX_PREFIX . 'name')->nullable(false);
        $table->timestamps();
    }

    /** Drop the recipe types table if it exists. */
    public function dropSchema(): void
    {
        Schema::dropIfExists($this->tablename);
    }

    /** Configure this migration to manage the recipe types table. */
    public function __construct()
    {
        parent::__construct(self::RECIPETYPES_TABLE_NAME);
    }
};

/** Creates the recipes table. */
class RecipesMigration extends MixifyMyRecipiesTableMigration
{
    /** Define recipe details and the optional recipe type relationship. */
    public function createSchema(Blueprint $table): void
    {
        $table->id()->primary();
        $table->string('name', length: self::NAME_COLUMN_LENGTH)->unique(self::UNIQUE_INDEX_PREFIX . 'name')->nullable(false);
        $table->string('tags', length: self::TAGS_COLUMN_LENGTH);

        $this->buildForeignKey(
            $table,
            'recipetypeid',
            self::RECIPETYPES_TABLE_NAME,
            nullable: true
        )->onDelete('set null');

        $table->unsignedInteger('numberofpeople');
        $table->text('preparation');
        $table->time('preparationtime', precision: 0)->nullable();
        $table->unsignedBigInteger('createdby')->nullable();
        $table->timestamps();
    }

    /** Drop the recipes table if it exists. */
    public function dropSchema(): void
    {
        Schema::dropIfExists($this->tablename);
    }

    /** Configure this migration to manage the recipes table. */
    public function __construct()
    {
        parent::__construct(self::RECIPES_TABLE_NAME);
    }
};

/** Creates the recipe ingredients table. */
class RecipeIngredientsMigration extends MixifyMyRecipiesTableMigration
{
    /** Define recipe-to-ingredient links, quantities, and optional units. */
    public function createSchema(Blueprint $table): void
    {
        $this->buildForeignKey(
            $table,
            'recipeid',
            self::RECIPES_TABLE_NAME
        )->onDelete('cascade');
        
        $this->buildForeignKey(
            $table,
            'ingredientid',
            self::INGREDIENTS_TABLE_NAME
        )->onDelete('cascade');

        $this->buildForeignKey(
            $table, 
            'unitid',
            self::UNITS_TABLE_NAME,
            nullable: true
        )->onDelete('set null');

        $table->float('quantity', precision: 2);
        $table->timestamps();

        $table->primary(['recipeid', 'ingredientid']);
    }

    /** Drop the recipe ingredients table if it exists. */
    public function dropSchema(): void
    {
        Schema::dropIfExists($this->tablename);
    }

    /** Configure this migration to manage the recipe ingredients table. */
    public function __construct()
    {
        parent::__construct(self::RECIPE_INGREDIENTS_TABLE_NAME);
    }
};

/** Creates the menus table. */
class MenusMigration extends MixifyMyRecipiesTableMigration
{
    /** Define menu names, tags, creator, and timestamps. */
    public function createSchema(Blueprint $table): void
    {
        $table->id()->primary();
        $table->string('name', length: self::NAME_COLUMN_LENGTH)->unique(self::UNIQUE_INDEX_PREFIX . 'name')->nullable(false);
        $table->string('tags', length: self::TAGS_COLUMN_LENGTH);
        $table->unsignedBigInteger('createdby')->nullable();
        $table->timestamps();
    }

    /** Drop the menus table if it exists. */
    public function dropSchema(): void
    {
        Schema::dropIfExists($this->tablename);
    }

    /** Configure this migration to manage the menus table. */
    public function __construct()
    {
        parent::__construct(self::MENUS_TABLE_NAME);
    }
};

/** Creates the menu recipes table. */
class MenuRecipesMigration extends MixifyMyRecipiesTableMigration
{
    /** Define menu-to-recipe links and their display positions. */
    public function createSchema(Blueprint $table): void
    {
        $this->buildForeignKey(
            $table, 
            'menuid',
            self::MENUS_TABLE_NAME
        )->onDelete('cascade');
        
        $this->buildForeignKey(
            $table, 
            'recipeid',
            self::RECIPES_TABLE_NAME
        )->onDelete('cascade');

        $table->unsignedInteger('position');
        $table->timestamps();

        $table->primary(['menuid', 'recipeid']);
    }

    /** Drop the menu recipes table if it exists. */
    public function dropSchema(): void
    {
        Schema::dropIfExists($this->tablename);
    }

    /** Configure this migration to manage the menu recipes table. */
    public function __construct()
    {
        parent::__construct(self::MENU_RECIPES_TABLE_NAME);
    }
};

/** Creates all the MixifyMyRecipies migrations. */
class CreateInitialMixifymyrecipesMigrations extends TableMigrations
{
    /** Register each table migration in dependency order. */
    public function __construct()
    {
        parent::__construct([
            new UnitsMigration(),
            new IngredientTypesMigration(),
            new IngredientsMigration(),
            new RecipeTypesMigration(),
            new RecipesMigration(),
            new RecipeIngredientsMigration(),
            new MenusMigration(),
            new MenuRecipesMigration(),
        ]);
    }
};

// Laravel executes this anonymous migration, which creates and drops all application tables.
return new CreateInitialMixifymyrecipesMigrations();
