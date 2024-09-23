<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackApiUsage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $today = Carbon::today();

        $apiUsage = $user->apiUsages()->firstOrCreate(
            ['date' => $today],
            ['request_count' => 0]
        );

        $apiUsage->increment('request_count');

        $monthlyUsage = $user->apiUsages()
            ->where('date', '>=', $today->startOfMonth())
            ->sum('request_count');

        if($monthlyUsage > 10000) {
            return response()->json([
                'message' => 'Monthly API request limit exceeded'
            ], 429);
        }

        return $next($request);
    }
}
