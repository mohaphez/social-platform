<?php

declare(strict_types=1);

return [

    'manager' => [

        'post' => [

            'model'  => 'Post',
            'plural' => 'Posts',

            'sections' => [
                'assets_code' => [
                    'label'       => 'Assets & Setting',
                    'description' => 'Customize header and footer tags for each page.'
                ]
            ],

            'inputs' => [
                'title' => [
                    'label' => 'Title',
                ],
                'slug' => [
                    'label' => 'Slug',
                ],
                'lang' => [
                    'label' => 'Language',
                ],
                'description' => [
                    'label' => 'Description',
                ],
                'content' => [
                    'label' => 'Content',
                ],
                'user_id' => [
                    'label' => 'Author',
                ],
                'published_at' => [
                    'label' => 'Publish Date',
                ],
                'cover_url' => [
                    'label' => 'Cover Image',
                ],
                'status' => [
                    'label' => 'Status',
                ],
                'cache_ttl' => [
                    'label' => 'Cache TTL (minutes)',
                    'help'  => 'Zero means no cache',
                ],
            ],

            'table' => [
                'th' => [
                    'title'        => 'Title',
                    'slug'         => 'Slug',
                    'lang'         => 'Language',
                    'published_at' => 'Publish Date',
                    'user_id'      => 'Author',
                    'status'       => 'Status',
                ]
            ],
        ],


    ]
];
