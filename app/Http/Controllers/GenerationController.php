<?php

namespace App\Http\Controllers;

use App\Http\Resources\GenerationResource;
use App\Models\MakeModel;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class GenerationController extends Controller
{
    public function index($model)
    {
        $model = MakeModel::findOrFail($model);
        return GenerationResource::collection($model->generations);
    }
}
