<?php
return [
        'posts'=>
            [
                [
                    'slug'=>'furniture',
                    'labels'=>
                        [
                            'name' => 'Мебель',
                            'singular_name' => 'Мебель',
                            'add_new' => 'добавить новую запись',
                            'add_new_item' => 'добавить новую запись',
                            'edit_item' => 'Редактировать запись',
                            'new_item' => 'Новая страница записи',
                            'view_item' =>'Посмотреть страницу записи',
                            'search_items' => 'Искать',
                            'not_found' =>  'Нет такой страницы',
                            'not_found_in_trash' => 'Нет удаленных страниц',
                            'parent_item_colon' => 'Родитель объекта:',
                            'menu_name' => 'Мебель',
                        ],
                    'args'=>
                        [
                            'hierarchical' => false,
                            'supports' => array( 'title', 'thumbnail', 'editor','custom-fields'),
                            'public' => true,
                            'map_meta_cap' => true,
                            'show_ui' => true,
                            'menu_position'=>12,
                            'menu_icon' => 'dashicons-admin-multisite',
                            'show_in_nav_menus' => false,
                            'publicly_queryable' => true,
                            'exclude_from_search' => true,
                            'has_archive' => true,
                            'query_var' => true,
                            'can_export' => false,
                            'rewrite' => true,
                            'capability_type' => 'page',
                        ],
                ],
                [
                    'slug'=>'portfolio',
                    'labels'=>
                        [
                            'name' => 'Выполненые работы',
                            'singular_name' => 'Выполненые работы',
                            'add_new' => 'добавить новую запись',
                            'add_new_item' => 'добавить новую запись',
                            'edit_item' => 'Редактировать запись',
                            'new_item' => 'Новая страница записи',
                            'view_item' =>'Посмотреть страницу записи',
                            'search_items' => 'Искать',
                            'not_found' =>  'Нет такой страницы',
                            'not_found_in_trash' => 'Нет удаленных страниц',
                            'parent_item_colon' => 'Родитель объекта:',
                            'menu_name' => 'Выполненые работы',
                        ],
                    'args'=>
                        [
                            'hierarchical' => false,
                            'supports' => array( 'title', 'thumbnail', 'editor','custom-fields'),
                            'public' => true,
                            'map_meta_cap' => true,
                            'show_ui' => true,
                            'menu_position'=>13,
                            'menu_icon' => 'dashicons-admin-home',
                            'show_in_nav_menus' => false,
                            'publicly_queryable' => true,
                            'exclude_from_search' => true,
                            'has_archive' => true,
                            'query_var' => true,
                            'can_export' => false,
                            'rewrite' => true,
                            'capability_type' => 'page',
                        ],
                ]
            ],
        'taxonomy'=>
            [
                [
                    'slug'=>'tax_cat',
                    'postSlug'=>['portfolio','furniture'],
                    'labels'=>
                        [
                            'name' => 'Категории',
                            'singular_name' => "Категория",
                            'search_items' => 'Поиск по категориям',
                            'all_items' => 'Все категории',
                            'parent_item' => 'Родительская категория',
                            'parent_item_colon' => 'Родительская категория:',
                            'edit_item' => 'Редактировать категорию',
                            'update_item' => 'Обновить категорию',
                            'add_new_item' => 'Добавить новую категорию',
                            'new_item_name' => 'Имя новой категории',
                            'menu_name' => 'Категории',
                        ],
                    'args'=>
                        [
                            'hierarchical' => true,
                            'show_ui' => true,
                            'query_var' => true,
                            'rewrite' => false
                        ],
                ]
            ]
    ];