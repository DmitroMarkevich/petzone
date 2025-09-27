<?php

return [
    [
        'name' => 'Для Собак',
        'slug' => 'dogs',
        'children' => [
            [
                'name' => 'Корм для собак',
                'slug' => 'dog-food',
                'children' => [
                    ['name' => 'Сухий корм', 'slug' => 'dog-dry-food'],
                    ['name' => 'Вологий корм', 'slug' => 'dog-wet-food'],
                    ['name' => 'Ласощі', 'slug' => 'dog-treats'],
                ]
            ],
            [
                'name' => 'Аксесуари для собак',
                'slug' => 'dog-accessories',
                'children' => [
                    ['name' => 'Ліжка', 'slug' => 'dog-beds'],
                    ['name' => 'Нашийники', 'slug' => 'dog-collars'],
                    ['name' => 'Повідці', 'slug' => 'dog-leashes'],
                ]
            ],
        ]
    ],
    [
        'name' => 'Для Котів',
        'slug' => 'cats',
        'children' => [
            [
                'name' => 'Корм для котів',
                'slug' => 'cat-food',
                'children' => [
                    ['name' => 'Сухий корм', 'slug' => 'cat-dry-food'],
                    ['name' => 'Вологий корм', 'slug' => 'cat-wet-food'],
                    ['name' => 'Ласощі', 'slug' => 'cat-treats'],
                ]
            ],
            [
                'name' => 'Аксесуари для котів',
                'slug' => 'cat-accessories',
                'children' => [
                    ['name' => 'Когтеточки', 'slug' => 'cat-scratchers'],
                    ['name' => 'Лотки та наповнювачі', 'slug' => 'cat-litter'],
                    ['name' => 'Переноски', 'slug' => 'cat-carriers'],
                ]
            ],
        ]
    ],
    [
        'name' => 'Для Гризунів',
        'slug' => 'rodents',
        'children' => [
            ['name' => 'Їжа', 'slug' => 'rodent-food'],
            ['name' => 'Клітки', 'slug' => 'rodent-cages'],
            ['name' => 'Аксесуари для кліток', 'slug' => 'rodent-accessories'],
            ['name' => 'Наповнювачі', 'slug' => 'rodent-litter'],
            ['name' => 'Засоби для здоров’я', 'slug' => 'rodent-health'],
            ['name' => 'Іграшки', 'slug' => 'rodent-toys'],
        ]
    ],
    [
        'name' => 'Для Птахів',
        'slug' => 'birds',
        'children' => [
            ['name' => 'Їжа', 'slug' => 'bird-food'],
            ['name' => 'Клітки', 'slug' => 'bird-cages'],
            ['name' => 'Аксесуари для кліток', 'slug' => 'bird-accessories'],
            ['name' => 'Засоби для здоров’я', 'slug' => 'bird-health'],
            ['name' => 'Іграшки', 'slug' => 'bird-toys'],
        ]
    ],
    [
        'name' => 'Для Риб',
        'slug' => 'fish',
        'children' => [
            ['name' => 'Їжа', 'slug' => 'fish-food'],
            ['name' => 'Акваріуми', 'slug' => 'fish-aquariums'],
            ['name' => 'Освітлення', 'slug' => 'fish-lighting'],
            ['name' => 'Аксесуари для акваріумів', 'slug' => 'fish-accessories'],
            ['name' => 'Засоби для очищення', 'slug' => 'fish-cleaning'],
            ['name' => 'Засоби для здоров’я', 'slug' => 'fish-health'],
        ]
    ],
    [
        'name' => 'Для Рептилій',
        'slug' => 'reptiles',
        'children' => [
            ['name' => 'Їжа', 'slug' => 'reptile-food'],
            ['name' => 'Терраріуми', 'slug' => 'reptile-terrariums'],
            ['name' => 'Опалення', 'slug' => 'reptile-heating'],
            ['name' => 'Освітлення', 'slug' => 'reptile-lighting'],
            ['name' => 'Засоби для здоров’я', 'slug' => 'reptile-health'],
        ]
    ],
    [
        'name' => 'Загальні Товари',
        'slug' => 'general',
        'children' => [
            ['name' => 'Препарати від бліх і кліщів', 'slug' => 'general-flea-tick'],
            ['name' => 'Косметика та гігієна', 'slug' => 'general-hygiene'],
        ]
    ],
    [
        'name' => 'Інші Товари',
        'slug' => 'other',
        'children' => [
            ['name' => 'Сертифікати', 'slug' => 'other-certificates'],
            ['name' => 'Подарунки', 'slug' => 'other-gifts'],
        ]
    ],
];
