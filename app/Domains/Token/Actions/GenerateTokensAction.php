<?php
declare(strict_types=1);

namespace App\Domains\Token\Actions;

use App\Domains\Core\Action;
use App\Domains\Token\CQRS\GenerateTokensCommand;
use App\Domains\Token\Logic\TokenLogic;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class GenerateTokensAction
 * @package App\Domains\Token\Actions
 */
class GenerateTokensAction extends Action
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
	 * @param string $amount
	 * @return JsonResponse
	 */
	public function handle(Request $request, string $amount): JsonResponse
	{
		try{
			$data = $this->tokenLogic->generateTokens($request->user(), intval($amount));
		}catch(Exception $e){
			return $this->handleException($e);
		}

		return $this->assembleResponse($data, 201);
	}
}