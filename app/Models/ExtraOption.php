<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ExtraOption',
    required: ['id', 'name'],
    properties: [
        new OA\Property(property: 'id', type: 'string', format: 'uuid'),
        new OA\Property(property: 'name', type: 'string'),
        new OA\Property(property: 'description', type: 'string', format: 'textarea'),
    ]
)]class ExtraOption extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'description',
    ];

    public function tunes()
    {
        return $this->belongsToMany(Tune::class);
    }
}
