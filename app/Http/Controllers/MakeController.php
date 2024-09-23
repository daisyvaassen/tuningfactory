<?php

namespace App\Http\Controllers;

use App\Http\Resources\MakeResource;
use App\Models\Make;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class MakeController extends Controller
{
    public function index()
    {
        return MakeResource::collection(Make::all()->sortBy('name'));
    }
}
