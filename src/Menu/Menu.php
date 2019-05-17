<?php

namespace App\Menu;

use Douma\NavigationMenu\ActiveStrategies\RequestUri;
use Douma\NavigationMenu\Builder;

class Menu extends Builder
{
    protected function _build(Builder $builder)
    {
        $builder
            ->setName('Menu')
            ->setActiveStrategy(new RequestUri())
            ->addChild()
                ->setName('Hello world')
                ->setLink('/article')
            ->end()
            ->addChild()
                ->setName('Hello world')
                ->setLink('#')
            ->end()
        ->end();
    }
}
