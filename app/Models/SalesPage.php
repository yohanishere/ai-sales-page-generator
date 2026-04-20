<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesPage extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'headline',
        'subheadline',
        'description',
        'benefits',
        'features',
        'social_proof',
        'price_display',
        'cta',
        'style',
        'input_data'
    ];

    protected $casts = [
        'benefits' => 'array',
        'features' => 'array',
        'input_data' => 'array',
    ];
}
