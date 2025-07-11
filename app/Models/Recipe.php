<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'ingredients',
    ];

    public function casts(): array
    {
        return [
            'type' => 'string',
            'ingredients' => 'array',
        ];
    }
}
