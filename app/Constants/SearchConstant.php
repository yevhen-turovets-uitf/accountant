<?php

namespace App\Constants;

class SearchConstant
{
    public const SORTED_COLUMN = 'created_at';

    public const MODELS = [
        'App\Models\Handbook',
        'App\Models\Consultation',
        'App\Models\Blank',
        'App\Models\Norm',
        'App\Models\Report',
        'App\Models\TaxSystem',
        'App\Models\News',
    ];

    public const SEARCH_FIELDS = [
        'App\Models\Handbook' => [
            'title',
        ],
        'App\Models\Consultation' => [
            'title',
        ],
        'App\Models\Blank' => [
            'title',
        ],
        'App\Models\Norm' => [
            'title',
        ],
        'App\Models\Report' => [
            'title',
        ],
        'App\Models\TaxSystem' => [
            'title',
        ],
        'App\Models\News' => [
            'title',
            'description',
            'text',
        ],
    ];
}
