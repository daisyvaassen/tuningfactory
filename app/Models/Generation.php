<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Generation',
    required: ['id', 'year_from'],
    properties: [
        new OA\Property(property: 'id', type: 'string', format: 'uuid'),
        new OA\Property(property: 'name', type: 'string'),
        new OA\Property(property: 'year_from', type: 'integer'),
        new OA\Property(property: 'year_to', type: 'integer'),
        new OA\Property(property: 'image', type: 'string', format: 'uri'),
    ]
)]
class Generation extends Model implements Sortable, HasMedia
{
    use HasUuids, SortableTrait, InteractsWithMedia;

    protected $fillable = [
        'year_from',
        'year_to',
        'sort',
        'make_model_id',
    ];

    public $sortable = [
        'order_column_name' => 'sort',
        'sort_when_creating' => true,
    ];

    public function makeModel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MakeModel::class);
    }

    public function engines(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Engine::class);
    }
}
