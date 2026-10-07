<?php

namespace Database\Migrations;

use Database\Migrations\TableMigration;

abstract class MixifyMyRecipiesTableMigration extends TableMigration {
    public const UNITS_TABLE_NAME = 'units';
    public const INGREDIENTS_TABLE_NAME = 'ingredients';
    public const INGREDIENTTYPES_TABLE_NAME = 'ingredienttypes';
    public const RECIPES_TABLE_NAME = 'recipes';
    public const RECIPETYPES_TABLE_NAME = 'recipetypes';
    public const RECIPE_INGREDIENTS_TABLE_NAME = 'recipeingredients';
    public const MENUS_TABLE_NAME = 'menus';
    public const MENU_RECIPES_TABLE_NAME = 'menurecipes';

    public const NAME_COLUMN_LENGTH = 100;
    public const TAGS_COLUMN_LENGTH = 500;
};