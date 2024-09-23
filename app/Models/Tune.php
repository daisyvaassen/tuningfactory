<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Tune',
    required: ['id', 'name'],
    properties: [
        new OA\Property(property: 'id', type: 'string', format: 'uuid'),
        new OA\Property(property: 'name', type: 'string'),
        new OA\Property(property: 'original_hp', type: 'integer'),
        new OA\Property(property: 'original_nm', type: 'integer'),
        new OA\Property(property: 'tuned_hp', type: 'integer'),
        new OA\Property(property: 'tuned_nm', type: 'integer'),
        new OA\Property(property: 'ecu', type: 'string'),
        new OA\Property(property: 'ecu_category', type: 'string'),
        new OA\Property(property: 'cylinder_capacity', type: 'string'),
        new OA\Property(property: 'compression_ratio', type: 'string'),
        new OA\Property(property: 'bore_x_stroke', type: 'string'),
        new OA\Property(property: 'engine_number', type: 'string'),
        new OA\Property(property: 'engine_ecu', type: 'string'),
        new OA\Property(property: 'gearbox', type: 'string'),
        new OA\Property(property: 'read_methods', type: 'string'),
        new OA\Property(property: 'extra_options', type: 'array', items: new OA\Items(ref: '#/components/schemas/ExtraOption')),
    ]
)]
class Tune extends Model implements Sortable
{
    use HasUuids, SortableTrait;

    protected $fillable = [
        'original_hp',
        'original_nm',
        'tuned_hp',
        'tuned_nm',
        'ecu',
        'ecu_category',
        'cylinder_capacity',
        'compression_ratio',
        'bore_x_stroke',
        'engine_number',
        'engine_ecu',
        'gearbox',
        'read_methods',
        'name',
        'sort',
        'engine_id',
    ];

    public $sortable = [
        'order_column_name' => 'sort',
        'sort_when_creating' => true,
    ];

    public function engine(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Engine::class);
    }

    public function extraOptions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(ExtraOption::class);
    }
}
