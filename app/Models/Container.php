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
        'name',
        'type',
        'size',
        'unit',
    ];

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'type' => 'string',
            'size' => 'float',
            'unit' => 'string',
        ];
    }
}
