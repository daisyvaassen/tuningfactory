<?php

namespace App\Http\Controllers;

use App\Http\Resources\EngineResource;
use App\Models\Engine;
use App\Models\Generation;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class EngineController extends Controller
{
    public function index($generation)
    {
        $generation = Generation::findOrFail($generation)->with('engines')->first();
        return EngineResource::collection($generation->engines);
    }

    public function show($engine)
    {
        $engine = Engine::findOrFail($engine)->load('tunes', 'tunes.extraOptions');
        return new EngineResource($engine);
    }
}
