<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Engine',
    required: ['id', 'name', 'fuel_type'],
    properties: [
        new OA\Property(property: 'id', type: 'string', format: 'uuid'),
        new OA\Property(property: 'name', type: 'string'),
        new OA\Property(property: 'fuel_type', type: 'string'),
        new OA\Property(property: 'tunes', type: 'array', items: new OA\Items(ref: '#/components/schemas/Tune')),
    ]
)]
class Engine extends Model implements Sortable
{
    use HasUuids, SortableTrait;

    protected $fillable = [
        'name',
        'generation_id',
        'sort',
        'fuel_type',
        'visible',
    ];

    protected $casts = [
        'visible' => 'boolean',
        'additional_options' => 'array',
    ];

    public $sortable = [
        'order_column_name' => 'sort',
        'sort_when_creating' => true,
    ];

    public function generation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Generation::class);
    }

    public function tunes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Tune::class);
    }
}
