<?php
return
    [
        'optionsPage'=>
            [
                [
                    'title'=>'Настройка Сайта',
                    'slug'=>'option_site',
                    'position' => 3,
                    'icon' => 'dashicons-admin-tools',
                    'id' => 'options',
                ],
            ],
        'optionsSubPage'=>
            [
                [
                    'id' => 'options_post-furniture',
                    'slug'=>'option_post-furniture',
                    'title'=>'Настройка блоков "Карточка товара"',
                    'parent_slug'=> 'edit.php?post_type=furniture',
                ],
                [
                    'id' => 'options_post-portfolio',
                    'slug'=>'option_post-portfolio',
                    'title'=>'Настройка блоков "Выполненые работы"',
                    'parent_slug'=> 'edit.php?post_type=portfolio',
                ],
            ],

    ];