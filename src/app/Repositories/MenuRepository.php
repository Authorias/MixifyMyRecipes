<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Repositories\IMenuRepository;

class MenuRepository extends Repository implements IMenuRepository {
    public function __construct() {
        parent::__construct(Menu::class);
    }
}