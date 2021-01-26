<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Log;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth; 
class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user=Auth::user();
                Log::info($user);
                Log::info($user->role."*********************************************");
                

        if($user->role!=config('constants.role.USER')){

            return response()->json(['message'=>'User must have user role.']);
        }
        return $next($request);
    }
}
