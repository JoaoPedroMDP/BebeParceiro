<?php
declare(strict_types=1);

namespace App\Domains\Token\Actions;

use App\Domains\Token\CQRS\GenerateTokensCommand;
use App\Domains\Token\Logic\TokenLogic;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class GenerateTokensAction
 * @package App\Domains\Token\Actions
 */
class GenerateTokensAction
{

	/**
	 * @var TokenLogic
	 */
	private $tokenLogic;

	/**
	 * @param TokenLogic $tokenLogic
	 */
	public function __construct(TokenLogic $tokenLogic)
	{
		$this->tokenLogic = $tokenLogic;
	}

	/**
	 * @param Request $request
	 * @param $amount
	 * @return JsonResponse
	 */
	public function handle(Request $request, $amount): JsonResponse
	{
		try{
			$response = response()->json(
				$this->tokenLogic->generateTokens(GenerateTokensCommand::fromArray($request->user(), $amount)
				)
				,201
			);
		}catch(Exception $e){
			$response = response()->json("Não foi possível concluir a requisição");
		}

		return $response;
	}
}