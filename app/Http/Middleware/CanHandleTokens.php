<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class CanHandleTokens
 * @package App\Http\Middleware
 */
class CanHandleTokens
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
		if($request->user()->can("Handle tokens")){
			return $next($request);
		}else{
			return response()->json("Você não tem permissão para realizar esta ação", 401);
		}
    }
}
