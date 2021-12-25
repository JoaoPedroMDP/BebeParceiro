<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class CanGenerateTokens
 * @package App\Http\Middleware
 */
class CanGenerateTokens
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
		if($request->user()->can("Generate tokens")){
			return $next($request);
		}else{
			return response()->json("Você não tem autorização para gerar tokens");
		}
    }
}
