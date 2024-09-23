<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Make',
    required: ['id', 'name', 'slug'],
    properties: [
        new OA\Property(property: 'id', type: 'string', format: 'uuid'),
        new OA\Property(property: 'name', type: 'string'),
        new OA\Property(property: 'slug', type: 'string'),
        new OA\Property(property: 'image', type: 'string', format: 'uri'),
    ]
)]
class Make extends Model implements HasMedia
{
    use HasUuids, InteractsWithMedia;

    protected $fillable = ['name', 'slug'];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function makeModels(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MakeModel::class);
    }
}

