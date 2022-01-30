<?php
declare(strict_types=1);

namespace App\Domains\Token\Actions;

use App\Domains\Core\Action;
use App\Domains\Token\Logic\TokenLogic;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class IndexTokensAction
 * @package App\Domains\Token\CQRS
 */
class IndexTokensAction extends Action
{
	/**
	 * @var TokenLogic
	 */
	public $tokenLogic;

	/**
	 * @param TokenLogic $tokenLogic
	 */
	public function __construct(TokenLogic $tokenLogic)
	{
		$this->tokenLogic = $tokenLogic;
	}

	/**
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function handle(Request $request): JsonResponse
	{
		try{
			$data = $this->tokenLogic->indexTokens($request->user());
		}catch(Exception $e){
			return $this->handleException($e);
		}

		return $this->assembleResponse($data, 200);
	}
}