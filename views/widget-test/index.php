<?php

use timurmelnikov\widgets\PanelMenu;

echo PanelMenu::widget(['items' => [
    ['label' => 'Пункт меню1', 'url' => ['#']],
    ['label' => 'Пункт меню2', 'url' => ['#']],
    ['label' => 'Пункт меню3', 'url' => ['#']],
],
    'heading' => 'Текст заголовка...',
    'type' => 'panel-danger',
    'footer' => 'Текст подвала...'
]);