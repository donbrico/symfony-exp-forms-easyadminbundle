<?php

namespace App\Twig;

use Douma\NavigationMenu\RenderStrategies\RenderStrategyBootstrap4;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Menu extends AbstractExtension
{
    private $menu;
    public function __construct(\App\Menu\Menu $menu)
    {
        $this->menu = $menu;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('menu', [$this, 'renderMenu']),
        ];
    }

    public function renderMenu()
    {
        return $this->menu->build()->render(new RenderStrategyBootstrap4);
    }
}
