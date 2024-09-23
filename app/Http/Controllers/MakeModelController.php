<?php

namespace App\Http\Controllers;

use App\Http\Resources\MakeModelResource;
use App\Models\Make;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class MakeModelController extends Controller
{
    public function index($make)
    {
        $make = Make::findOrFail($make);
        return MakeModelResource::collection($make->makeModels->sortBy('sort'));
    }
}
