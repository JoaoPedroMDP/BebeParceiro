<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class GeneralPermission
 * @package App\Http\Middleware
 */
class GeneralPermission
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
		if($request->user()->can('General')) {
			return $next($request);
		}else{
			return response()->json("Você não tem permissão para realizar esta ação!", 403);
		}
    }
}
