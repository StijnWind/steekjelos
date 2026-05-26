<?php

return [
    'categories' => [
        [
            'name' => 'Klassiek',
            'items' => [
                [
                    'id' => 'vanille',
                    'name' => 'Vanille',
                    'description' => 'Romig ambachtelijk vanille-ijs',
                    'price_hint' => null,
                ],
                [
                    'id' => 'chocolade',
                    'name' => 'Chocolade',
                    'description' => 'Rijke Belgische chocolade',
                    'price_hint' => null,
                ],
                [
                    'id' => 'karamel',
                    'name' => 'Karamel',
                    'description' => 'Zachte karamel met een vleugje zout',
                    'price_hint' => null,
                ],
            ],
        ],
        [
            'name' => 'Fruit',
            'items' => [
                [
                    'id' => 'aardbei',
                    'name' => 'Aardbei',
                    'description' => 'Fris en fruitig met echte aardbeien',
                    'price_hint' => null,
                ],
                [
                    'id' => 'citroen',
                    'name' => 'Citroen',
                    'description' => 'Licht en verfrissend',
                    'price_hint' => null,
                ],
                [
                    'id' => 'mango',
                    'name' => 'Mango',
                    'description' => 'Tropisch zoet en romig',
                    'price_hint' => null,
                ],
            ],
        ],
        [
            'name' => 'Dips',
            'items' => [
                [
                    'id' => 'dip-chocolade',
                    'name' => 'Chocolade dip',
                    'description' => 'Vaste meerprijs per gekozen dip',
                    'kind' => 'dip',
                    'price_hint' => '+€10',
                ],
                [
                    'id' => 'dip-karamel',
                    'name' => 'Karamel dip',
                    'description' => 'Vaste meerprijs per gekozen dip',
                    'kind' => 'dip',
                    'price_hint' => '+€10',
                ],
                [
                    'id' => 'dip-aardbei',
                    'name' => 'Aardbeien dip',
                    'description' => 'Vaste meerprijs per gekozen dip',
                    'kind' => 'dip',
                    'price_hint' => '+€10',
                ],
            ],
        ],
        [
            'name' => "Extra's",
            'items' => [
                [
                    'id' => 'wafels',
                    'name' => 'Extra wafels',
                    'description' => 'Knapperige wafels bij het steekijs',
                    'price_hint' => null,
                ],
                [
                    'id' => 'topping',
                    'name' => 'Topping',
                    'description' => 'Chocolade- of fruit topping',
                    'price_hint' => null,
                ],
                [
                    'id' => 'sprinkles',
                    'name' => 'Sprinkles',
                    'description' => 'Kleurrijke hagelslag',
                    'price_hint' => null,
                ],
            ],
        ],
    ],
];
