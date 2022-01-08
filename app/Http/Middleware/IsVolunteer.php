<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class IsVolunteer
 * @package App\Http\Middleware
 */
class IsVolunteer
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
		if($request->user()->isVolunteer()){
			return $next($request);
		}

		return response()->json("É necessário ser um voluntário para acessar esse recurso");
    }
}