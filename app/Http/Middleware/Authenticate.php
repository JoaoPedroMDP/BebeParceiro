<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class Authenticate
 * @package App\Http\Middleware
 */
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request  $request
     * @return JsonResponse|string
     */
    protected function redirectTo($request)
    {
		$warning = "Você precisa se autenticar para acessar essa funcionalidade!";
        if (!$request->expectsJson()) {
            return $warning;
        }else{
	        return response()->json($warning);
        }
    }
}
