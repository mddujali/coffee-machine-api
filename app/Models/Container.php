<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'quantity',
    ];

    protected function casts(): array
    {
        return [
            'type' => 'string',
            'quantity' => 'decimal',
        ];
    }
}
