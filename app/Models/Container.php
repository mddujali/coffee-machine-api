<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $type
 * @property float $size
 * @property string $unit
 */
class Container extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'size',
        'unit',
    ];

    protected function casts(): array
    {
        return [
            'type' => 'string',
            'size' => 'float',
            'unit' => 'string',
        ];
    }
}
