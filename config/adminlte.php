<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Sword Art Online',

    'title_prefix' => 'SAO',

    'title_postfix' => 'SAO',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Sao</b>NG',

    'logo_mini' => '<b>N</b>G',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'black',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'PRINCIPAL',
        [
            'text' => 'Painel Admin',
            /*'url' => '#',*/
            'can' => 'menu-admin',
            'icon' => 'gears',
            'submenu' => [

                [
                    'text' => 'Noticias',
                    'url' => 'alNoticia',
                    'icon' => 'commenting-o',
                    /*'submenu' => [
                        [
                            'text' => 'Criar',
                            'url' => 'acNoticia',
                            'icon' => 'plus-square',
                        ],
                        [
                            'text' => 'Editar',
                            'url' => 'aeNoticia',
                            'icon' => 'pencil-square',
                        ],

                        [
                            'text' => 'Lista',
                            'url' => 'alNoticia',
                            'icon' => 'folder-open',
                        ],
                    ],*/
                ],
                [
                    'text' => 'Avatar',
                    'url' => 'alAvatar',
                    'icon' => 'users',
                ],
                [
                    'text' => 'Lista IMG Avatar',
                    'url' => 'alAvatarList',
                    'icon' => 'users',
                ],
                [
                    'text' => 'Itens',
                    'url' => 'alItem',
                    'icon' => 'magic',

                ],
                [
                    'text' => 'Quests',
                    'url' => 'alQuest',
                    'icon' => 'history',

                ],
                [
                    'text' => 'NPC',
                    'url' => 'aNPC',
                    'icon' => 'users',
                    'submenu' => [
                        [
                            'text' => 'Criar',
                            'url' => 'acNPC',
                            'icon' => 'plus-square',
                        ],
                        [
                            'text' => 'Editar',
                            'url' => 'aeNPC',
                            'icon' => 'pencil-square',
                        ],
                        [
                            'text' => 'Lista',
                            'url' => 'alNPC',
                            'icon' => 'folder-open',
                        ],
                    ],
                ],
                [
                    'text' => 'MOB',
                    'url' => 'aMob',
                    'icon' => 'users',
                    'submenu' => [
                        [
                            'text' => 'Criar',
                            'url' => 'acMOB',
                            'icon' => 'plus-square',
                        ],
                        [
                            'text' => 'Editar',
                            'url' => 'aeMOB',
                            'icon' => 'pencil-square',
                        ],
                        [
                            'text' => 'Lista',
                            'url' => 'alMOB',
                            'icon' => 'folder-open',
                        ],
                    ],
                ],
                [
                    'text' => 'Cidade',
                    'url' => 'aCidade',
                    'icon' => 'info-circle',
                    'submenu' => [
                        [
                            'text' => 'Criar',
                            'url' => 'acCidade',
                            'icon' => 'plus-square',
                        ],
                        [
                            'text' => 'Editar',
                            'url' => 'aeCidade',
                            'icon' => 'pencil-square',
                        ],
                        [
                            'text' => 'Lista',
                            'url' => 'alCidade',
                            'icon' => 'folder-open',
                        ],
                    ],
                ],
                [
                    'text' => 'Andar',
                    'url' => 'aAndar',
                    'icon' => 'user-circle',
                    'submenu' => [
                        [
                            'text' => 'Criar',
                            'url' => 'acAndar',
                            'icon' => 'plus-square',
                        ],
                        [
                            'text' => 'Editar',
                            'url' => 'aeAndar',
                            'icon' => 'pencil-square',
                        ],
                        [
                            'text' => 'Lista',
                            'url' => 'alAndar',
                            'icon' => 'folder-open',
                        ],
                    ],
                ],
            ],

        ],
        [
            'text' => 'Principal',
            'url' => 'home',
            'icon' => 'home',
            /*  'label'       => 4,
              'label_color' => 'success',*/
        ],
        [
            'text' => 'Perfil',
            'url' => 'perfil',
            'icon' => 'address-card',
            /*  'label'       => 1,
              'label_color' => 'success',*/
        ],
        'PERSONAGEM',
        [
            'text' => 'Personagem',
            /* 'url' => 'Perso/Personagem',*/
            'icon' => 'users',
            'submenu' => [
                [
                    'text' => 'Criar',
                    'url' => 'showP',
                    'icon' => 'user-plus',
                ],
                [
                    'text' => 'Selecionar',
                    'url' => 'personagem',
                    'icon' => 'users',
                    /* 'can' => 'adminuser',*/
                ],
                [
                    'text' => 'Status',
                    'url' => 'statusP',
                    'icon' => 'info-circle'
                ],
                ['text' => 'Avatar',
                    'url' => 'indexAvatar',
                    'icon' => 'user-circle',
                ],
            ],
        ],
        [
            'text' => 'Mochila',
            'url' => 'bag',
            'icon' => 'suitcase',
        ],
        [
            'text' => 'Habilidade',
            'url' => 'skill',
            'icon' => 'book',
        ],
        [
            'text' => 'Status',
            'icon' => 'share',
            'submenu' => [
                [
                    'text' => 'Treino',
                    'url' => '#',
                ],
                [
                    'text' => 'Missões',
                    'url' => '#',
                    'submenu' => [
                        [
                            'text' => 'Mapa',
                            'url' => '#',
                        ],
                        [
                            'text' => 'Evento',
                            'url' => '#',
                            'submenu' => [
                                [
                                    'text' => 'Evento 1',
                                    'url' => '#',
                                ],
                                [
                                    'text' => 'Evento 2',
                                    'url' => '#',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'text' => 'Level One',
                    'url' => '#',
                ],
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2' => true,
        'chartjs' => true,
        'pace' => true,
    ],

    'pace' => [
        'color' => 'black',
        'type' => 'corner-indicator',
    ],
];
