<?php
declare(strict_types=1);

namespace App\Domains\Core;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\isInstanceOf;

/**
 * Class Action
 * @package App\Domains\Core
 */
class Action
{
	/**
	 * @param $exception
	 * @return JsonResponse
	 */
	public function handleException($exception): JsonResponse
	{
		if( $exception instanceof BenignException){
			return $this->assembleResponse([], 400, $exception->getMessage(), $exception->getCode());
		}

		Log::error($exception->getMessage());
		return $this->assembleResponse([], 500, "Erro interno. Contate a administradora do sistema");

	}

	/**
	 * @param $data
	 * @param int $requestCode
	 * @param string $message
	 * @param $code
	 * @return JsonResponse
	 */
	public function assembleResponse($data, int $requestCode, string $message = '', $code = null): JsonResponse
	{
		return response()->json(
			[
				"message" => $message,
				"code" => $code ?? $requestCode,
				"data" => $data
			],
			$requestCode
		);
	}
}