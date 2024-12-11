<?php
// src/Entity/MenuItemId.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class MenuItemId
{
    private ?int $menu = null;
    private ?int $item = null;

    public function __construct(?int $menu = null, ?int $item = null)
    {
        $this->menu = $menu;
        $this->item = $item;
    }

    public function getMenu(): ?int
    {
        return $this->menu;
    }

    public function getItem(): ?int
    {
        return $this->item;
    }
}