<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'MakeModel',
    required: ['id', 'name', 'slug'],
    properties: [
        new OA\Property(property: 'id', type: 'string', format: 'uuid'),
        new OA\Property(property: 'name', type: 'string'),
    ]
)]
class MakeModel extends Model implements Sortable
{
    use HasUuids, SortableTrait;

    protected $fillable = ['name', 'make_id', 'sort'];

    public $sortable = [
        'order_column_name' => 'sort',
        'sort_when_creating' => true,
    ];

    public function make(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Make::class);
    }

    public function generations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Generation::class);
    }
}
